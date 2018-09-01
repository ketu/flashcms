<?php
/**
 * User: ketu.lai <ketu.lai@gmail.com>
 * Date: 2017/4/10 10:52
 */

namespace App\Http\Controllers\Backend\Newsletter;

use App\Http\Controllers\Backend\BackendController;
use App\Http\Requests\SubscriberRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;
use App\Models\Newsletter\Subscriber as SubscriberModel;

class SubscriberController extends BackendController
{
    public function index(Request $request)
    {
        $subscribers = SubscriberModel::all();
        return $this->render('newsletter.subscriber.index', [
            'subscribers' => $subscribers
        ]);
    }

    public function create(Request $request)
    {

        return $this->render('newsletter.subscriber.create', []);
    }

    public function save(SubscriberRequest $request)
    {
        try {
            $subscriber = new SubscriberModel();
            $subscriber->email = $request->get('email');
            $subscriber->status = $request->get('status', false);
            $subscriber->locale = app()->getLocale();
            $subscriber->save();
            return redirect()->route('subscriber.edit', ['id' => $subscriber->id])->with('success', 'notice.success');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('failed', $e->getMessage());
        }
    }


    public function edit(Request $request, $id)
    {
        $subscriber = SubscriberModel::findOrFail($id);
        return $this->render('newsletter.subscriber.edit', [
            'subscriber' => $subscriber,
        ]);
    }

    public function update(SubscriberRequest $request)
    {
        try {
            $id = $request->get('id');

            $subscriber = SubscriberModel::findOrFail($id);
            $subscriber->email = $request->get('email');
            $subscriber->status = $request->get('status', false);
            $subscriber->locale = app()->getLocale();
            $subscriber->save();
            return redirect()->route('subscriber')->with('success', 'notice.success');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('failed', $e->getMessage());

        }
    }

    public function delete(Request $request, $id)
    {
        $subscriber = SubscriberModel::findOrFail($id);
        $subscriber->delete();
    }
}