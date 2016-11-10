<?php

namespace App\Http\Controllers;

use App\SubscriptionPlan;
use App\User;
use Illuminate\Http\Request;
use Auth;
use Mockery\CountValidator\Exception;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $auth;
    /**
     * @var User
     */
    private $user;

    public function __construct(User $user)
    {
        $this->auth = Auth::user();
        $this->middleware('auth');
        $this->user = $user;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $plan = $user->plan;


        return view('home', compact('user', 'plan'));
    }

    public function paymentDetails()
    {

        $user = Auth::user();
        if (!$user->onTrial() && $user->subscribed(SubscriptionPlan::MAIN_SUBSCRIPTION)) {
            return redirect('/home')->with('error', 'You are a subscriber');
        }
        $plan = $user->plan;
        $clientToken = \Braintree_ClientToken::generate();

        return view('payment-details', compact('clientToken', 'plan', 'user'));
    }

    public function subscribe(Request $request)
    {
        $user = Auth::user();
        $plan = $user->plan;
        $paymentNonce = $request->get('payment_method_nonce');

        $subscribe = $user->newSubscription(SubscriptionPlan::MAIN_SUBSCRIPTION, $plan->plan_id);
        if ($user->onTrial() && $user->trial_ends_at) {
            $subscribe = $subscribe->trialDays($user->trial_ends_at->diffInDays());
        }

        try {

            $subscribe = $subscribe->create($paymentNonce, [
                'email' => $user->email,
            ]);

            if (!$subscribe) {
                throw new Exception('Unable to create subscription');
            }
        } catch (\Exception $e) {
            throw new Exception($e->getMessage());
        }

        $this->user
            ->where('id', $user->id)
            ->update(['trial_ends_at' => null]);

        return redirect('/home')->with('success', 'You have been successfully subscribed');
    }


    public function premium()
    {
        $user = Auth::user();
        $currentPlan = $user->plan;
        $plans = SubscriptionPlan::all();

        return view('premium', compact('user', 'currentPlan', 'plans'));
    }


    public function switchPlan(Request $request)
    {
        $user = Auth::user();
        $plans = SubscriptionPlan::all();
        $requestedPlanToSwitch = $request->get('plan');
        if (!$requestedPlanToSwitch) {
            return redirect()->back()->with('error', 'No Plan Provided');
        }

        $requestedPlanToSwitch = $plans->where('plan_id', $requestedPlanToSwitch)->first();
        if (!$requestedPlanToSwitch) {
            return redirect()->back()->with('error', 'Provided plan is invalid');
        }


        $plan = $user->subscription(SubscriptionPlan::MAIN_SUBSCRIPTION)
            ->swap($requestedPlanToSwitch->plan_id);

        if (!$plan) {
            return redirect()->back()->with('error', 'Some problem caused and unable to swap');
        }


        User::where('id', $user->id)
            ->update([
                'plan_id' => $requestedPlanToSwitch->id
            ]);

        return redirect()->back()->with('Succsess', 'You subscription paln has been changed.');
    }

    public function cancelPlan(Request $request)
    {
        $user = Auth::user();
        $canceledPlan = $user->subscription(SubscriptionPlan::MAIN_SUBSCRIPTION)->cancelNow();
        if ($canceledPlan) {
            User::where('id', $user->id)
                ->update([
                    'plan_id' => SubscriptionPlan::where('plan_id', 'STARTER')->first()->id
                ]);

            return redirect('/home')->with('success', 'Cancellation has been successfull and you have been reverted to started pack');
        }


        return redirect()->back()->with('Error', 'Some Problem occured.');
    }
}

