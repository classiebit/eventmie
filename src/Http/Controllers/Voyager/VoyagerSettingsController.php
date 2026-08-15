<?php

namespace Classiebit\Eventmie\Http\Controllers\Voyager;

use Facades\Classiebit\Eventmie\Eventmie;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use TCG\Voyager\Facades\Voyager;
use TCG\Voyager\Http\Controllers\VoyagerSettingsController as BaseVoyagerSettingsController;

class VoyagerSettingsController extends BaseVoyagerSettingsController
{
    public function callAction($method, $parameters)
    {
        $allowed = ['index', 'update'];
        if (! config('voyager.pkg_dev_mode') && ! in_array($method, $allowed, true)) {
            abort(403);
        }

        return parent::callAction($method, $parameters);
    }

    public function index()
    {
        // Check permission
        $this->authorize('browse', Voyager::model('Setting'));

        $data = Voyager::model('Setting')->orderBy('order', 'ASC')->get();

        $settings = [];
        $settings[__('voyager::settings.group_general')] = [];
        foreach ($data as $d) {
            if ($d->group == '' || $d->group == __('voyager::settings.group_general')) {
                $settings[__('voyager::settings.group_general')][] = $d;
            } else {
                $settings[$d->group][] = $d;
            }
        }
        if (count($settings[__('voyager::settings.group_general')]) == 0) {
            unset($settings[__('voyager::settings.group_general')]);
        }

        $groups_data = Voyager::model('Setting')->select('group')->distinct()->get();
        $groups = [];
        foreach ($groups_data as $group) {
            if ($group->group != '') {
                $groups[] = $group->group;
            }
        }

        $active = (request()->session()->has('setting_tab')) ? request()->session()->get('setting_tab') : old('setting_tab', key($settings));

        $view = 'eventmie::vendor.voyager.settings.index';

        return Eventmie::view($view, compact('settings', 'groups', 'active'));
    }

    public function update(Request $request)
    {
        // demo mode restrictions
        if (config('voyager.demo_mode')) {
            return back()->with([
                'message' => 'Demo Mode',
                'alert-type' => 'info',
            ]);
        }

        // Check permission
        $this->authorize('edit', Voyager::model('Setting'));

        $settings = Voyager::model('Setting')->all();

        foreach ($settings as $setting) {
            $content = $this->getContentBasedOnType($request, 'settings', (object) [
                'type' => $setting->type,
                'field' => str_replace('.', '_', $setting->key),
                'group' => $setting->group,
            ], $setting->details);

            if ($setting->type == 'image' && $content == null) {
                continue;
            }

            if ($setting->type == 'file' && $content == null) {
                continue;
            }

            if ($setting->type == 'password') {
                $passwordField = str_replace('.', '_', $setting->key);
                $content = $request->input($passwordField);
                if (! is_string($content) || $content === '') {
                    continue;
                }
            }

            $key = preg_replace('/^'.Str::slug($setting->group).'./i', '', $setting->key);

            $setting->group = $request->input(str_replace('.', '_', $setting->key).'_group');
            $setting->key = implode('.', [Str::slug($setting->group), $key]);
            $setting->value = $content;
            $setting->save();
        }

        request()->flashOnly('setting_tab');

        return back()->with([
            'message' => __('voyager::settings.successfully_saved'),
            'alert-type' => 'success',
        ]);
    }
}
