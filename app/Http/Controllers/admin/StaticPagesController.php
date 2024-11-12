<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Pages;
use Illuminate\Http\Request;

class StaticPagesController extends Controller
{
    public function mainPage()
    {
        $pages = Pages::get()->keyBy('key')->all();

        return view(
            'AdminPanel.staticPages.mainPage.index',
            [
                'title' => trans('common.mainPage'),
                'active' => 'mainPage',
                'pages' => $pages,

                'breadcrumbs' => [
                    [
                        'url' => '',
                        'text' => trans('common.pages')
                    ]
                ]
            ]
        );
    }

    public function contactUsPage()
    {
        $pages = Pages::get()->keyBy('key')->all();

        return view(
            'AdminPanel.staticPages.contactUsPage.index',
            [
                'title' => trans('common.contactUsPage'),
                'active' => 'contactUsPage',
                'pages' => $pages,

                'breadcrumbs' => [
                    [
                        'url' => '',
                        'text' => trans('common.pages')
                    ]
                ]
            ]
        );
    }

    public function aboutUsPage()
    {
        $pages = Pages::get()->keyBy('key')->all();

        return view(
            'AdminPanel.staticPages.aboutUsPage.index',
            [
                'title' => trans('common.aboutUsPage'),
                'active' => 'aboutUsPage',
                'pages' => $pages,

                'breadcrumbs' => [
                    [
                        'url' => '',
                        'text' => trans('common.pages')
                    ]
                ]
            ]
        );
    }

    public function updatePages(Request $request)
    {
        //dd($request->all());
        $this->validate($request, [
            'logo' => 'nullable|file|mimes:jpeg,jpg,png,gif',
            'fav' => 'nullable|file|mimes:jpeg,jpg,png,gif',
            'socialPhoto' => 'nullable|file|mimes:jpeg,jpg,png,gif',
            'email' => 'nullable|email',
            'facebook' => 'nullable|url',
            'twitter' => 'nullable|url',
            'instagram' => 'nullable|url',
            'youtube' => 'nullable|url',
            'linkedin' => 'nullable|url',
            'pinterest' => 'nullable|url',
            'mobile' => 'nullable|numeric|regex:/[0-9]{10}/',
            'phone' => 'nullable|numeric|regex:/[0-9]{10}/',
        ]);

        //foreach inputs which is text and textarea
        foreach ($_POST as $key => $value) {
            if ($key != '_token') {
                $pages = Pages::where('key', $key)->first();
                if ($pages == '') {
                    $pages = new Pages;
                    $pages->key = $key;
                    $pages->save();
                }
                $pages->value = $value;
                $pages->update();
            }
        }

        //foreach inputs which is file
        foreach ($_FILES as $key => $value)
        {
            //if thier was a file uploaded with in the post
            if ($request->hasFile($key)) {
                $FileExt = $request->$key->extension();

                //check if thier was an old file
                $countvalue = Pages::where('key', $key)->count();
                if ($countvalue > 0) {

                    $EditOldFile = Pages::where('key', $key)->first();
                    //delete old file and upload the new file

                    delete_image('pages', $EditOldFile->value);
                    $file = upload_image_without_resize('pages', $request->$key);

                    $EditOldFile->value = $file;
                    $EditOldFile->save();
                } else {
                    $file = upload_image_without_resize('pages', $request->$key);
                    $NewFile = new Pages;
                    $NewFile->key = $key;
                    $NewFile->value = $file;
                    $NewFile->save();
                }
            }
        }

        session()->flash('success', trans('common.successMessageText'));
        return back();
    }
    
}
