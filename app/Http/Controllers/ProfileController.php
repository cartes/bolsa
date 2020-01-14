<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Http\Requests\EducationRequest;
use App\Http\Requests\ExperienceRequest;
use App\Http\Requests\PersonalDataRequest;
use App\User;
use App\UserEducation;
use App\UserExperience;
use App\UserLanguage;
use App\UserMeta;
use App\UserSkills;
use DB;
use Illuminate\Http\Request;

class ProfileController extends Controller
{

    public function index()
    {
        $id = session()->get('id');
        $user = User::where('id', $id)
            ->first()
            ->load('userMeta', 'userExperience', 'userLanguage', 'userSkills', 'userEducation');

        return view('user.profile', compact('user'));
    }

    public function update(PersonalDataRequest $request)
    {
        $id = session()->get('id');

        try {
            User::where('id', $id)
                ->update([
                    'name' => $request->get('name'),
                    'surname' => $request->get('surname'),
                    'birthday' => $request->get('birthday'),
                    'gender' => $request->get('gender'),
                    'nacionality' => $request->get('nacionality'),
                    'marital_status' => $request->get('marital_status'),
                    'rut_user' => $request->get('rut_user'),
                ]);

            $success = true;
        } catch (\Exception $exc) {

            $success = $exc->getMessage();
        }

        if ($success) {
            return back()->with('message', ['success', 'Datos actualizados']);
        }
    }

    public function salary(Request $request)
    {
        $id = session()->get('id');

        try {
            UserMeta::updateOrCreate(
                ['id_user' => $id],
                ['pretentions' => $request->get('pretentions')]
            );
            $success = true;

        } catch (\Exception $exc) {
            $success = $exc->getMessage();
        }

        if ($success) {
            return back()->with('message', ['success', 'Renta actualizada']);
        }

    }

    public function contact(ContactRequest $request)
    {
        $id = session()->get('id');

        try {
            User::where('id', $id)
                ->update([
                    'email' => $request->get('email')
                ]);
            UserMeta::updateOrCreate(
                ['id_user' => $id],
                [
                    'phone' => $request->get('phone'),
                    'address' => $request->get('address'),
                    'comune' => $request->get('comune'),
                    'city' => $request->get('city'),
                    'state' => $request->get('state'),
                    'country' => $request->get('country'),
                ]
            );

            $success = true;


        } catch (\Exception $exc) {
            $success = $exc->getMessage();
        }

        if ($success) {
            return back()->with('message', ['success', 'Datos de contacto actualizados']);
        }

    }

    public function experience(ExperienceRequest $request)
    {
        $id = session()->get('id');
        $experience = new UserExperience;
        try {
            $experience->id_user = $id;
            $experience->business_name = $request->business_name;
            $experience->business_activity = $request->business_activity;
            $experience->business_position = $request->business_position;
            $experience->experience_level = $request->experience_level;
            $experience->business_country = $request->business_country;
            $experience->month_from = $request->month_from;
            $experience->year_from = $request->year_from;
            $experience->month_to = $request->month_to;
            $experience->year_to = $request->year_to;
            $experience->area = $request->area;
            $experience->sub_area = $request->sub_area;
            $experience->description = $request->description;
            $experience->dependents = $request->dependents;

            $experience->save();

            $success = true;
        } catch (\Exception $exc) {
            $success = $exc->getMessage();
        }

        if ($success) {
            return back()->with('message', ['success', 'Experiencia Laboral Actualizada']);
        }

    }

    public function education(EducationRequest $request)
    {
        $id = session()->get('id');
        $education = new UserEducation;

        try {
            $education->id_user = $id;
            $education->country = $request->country_st;
            $education->studies = $request->studies;
            $education->condition = $request->condition;
            $education->title = $request->title;
            $education->area = $request->area_st;
            $education->month_from = $request->month_from_st;
            $education->year_from = $request->year_from_st;
            $education->month_to = $request->month_to_st;
            $education->year_to = $request->year_to_st;
            $education->to_present = $request->to_present_st;
            $education->institution = $request->institution;

            $education->save();

            $success = true;
        } catch (\Exception $exc) {
            $success = $exc->getMessage();
        }

        if ($success) {
            return back()->with('message', ['success', 'Experiencia Laboral Actualizada']);
        }

    }

    public function objectives(Request $request)
    {
        $id = session()->get('id');

        try {
            UserMeta::updateOrCreate(
                ['id_user' => $id],
                ['objectives' => $request->get('objectives')]
            );
            $success = true;

        } catch (\Exception $exc) {
            $success = $exc->getMessage();
        }

        if ($success) {
            return back()->with('message', ['success', 'Objetivos laborales Actualizada']);
        }
    }

    public function languages(Request $request)
    {
        $id = session()->get('id');
        $lang = new UserLanguage;

        try {
            $lang->id_user = $id;
            $lang->language = $request->language;
            $lang->level_written = $request->level_written;
            $lang->level_spoken = $request->level_spoken;

            $lang->save();

            $success = true;
        } catch (\Exception $exc) {
            $success = $exc->getMessage();
        }

        if ($success) {
            return back()->with('message', ['success', 'Lenguages actualizados']);
        }

    }

    public function skills(Request $request)
    {
        $id = session()->get('id');
        $skills = new UserSkills;

        try {
            $skills->id_user = $id;
            $skills->skill = $request->skill;
            $skills->save();

            $success = true;
        } catch (\Exception $exc) {
            $success = $exc->getMessage();
        }

        if ($success) {
            return back()->with('message', ['success', 'Conocimientos actualizados']);
        }

    }
}
