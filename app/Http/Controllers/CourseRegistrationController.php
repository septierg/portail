<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Product;
use App\Models\Registration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class CourseRegistrationController extends Controller
{

    public function index(Product $product)
    {
        $this->authorize('viewAny', $product); // facultatif selon ta policy

        $registrations = $product->registrations()->latest()->get();

        return view('products.registrations.index', compact('product', 'registrations'));
    }


    public function create(Product $product)
    {
        return view('products.registrations.create', compact('product'));
    }

    public function store(Request $request, Product $product)
    {

        // Validation
        $validated = $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname'  => 'required|string|max:255',
            'age'       => 'required|numeric|min:1|max:120',
            'email'     => 'required|email|max:255',
            'password'  => 'required|string|min:6|confirmed',
        ]);

        // Si utilisateur exist, Vérifier s'il est déjà inscrit à ce cours
        $user = User::where('email', $validated['email'])->first();

        if ($user) {

            $alreadyRegistered = Registration::where('product_id', $product->id)
                ->where('email', $validated['email'])
                ->exists();

            if ($alreadyRegistered) {
                return redirect()->route('dashboard')->with('error', 'Vous êtes déjà inscrit à ce cours.');
            }

            Registration::create([
                'product_id' => $product->id,
                'firstname'  => $validated['firstname'],
                'lastname'       => $validated['lastname'],
                'age'        => $validated['age'],
                'email'      => $validated['email'],
            ]);

            return redirect()->route('dashboard')
                ->with('success', 'Inscription réussie ! Un compte a été créé, vous pouvez maintenant vous connecter.');


        } else { // si utilisateur exist pas, alors on le rajoute ensuite on l'enregistre au cours

            $user = User::create([
                'name'     => $validated['firstname'] . ' ' . $validated['lastname'],
                'email'    => $validated['email'],
                'password' => Hash::make($validated['password']),
            ]);

            Registration::create([
                'product_id' => $product->id,
                'firstname'  => $validated['firstname'],
                'lastname'       => $validated['lastname'],
                'age'        => $validated['age'],
                'email'      => $validated['email'],
            ]);
        }

        return redirect()->route('dashboard')
            ->with('success', 'Inscription réussie ! Un compte a été créé, vous pouvez maintenant vous connecter.');


    }
}
