<?php

namespace Database\Seeders;

use App\Models\Student;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $students = [
            ['name' => "Sean Abot", "subject" => "Maths", "marks" => "77"],
            ['name' => "Shawn Tate", "subject" => "English", "marks" => "72"],
            ['name' => "Shivam", "subject" => "Physics", "marks" => "78"],
            ['name' => "Mitchelle", "subject" => "Maths", "marks" => "78"],
            ['name' => "Shiv Yadav", "subject" => "Chemistry", "marks" => "80"],
            ['name' => "Shiv Yadav", "subject" => "Hindi", "marks" => "76"],
            ['name' => "Shiv Yadav", "subject" => "Physics", "marks" => "77"],
        ];
        
        foreach( $students as $student_data ) {
            $student = new Student;
            $student->name    = $student_data['name'];
            $student->subject = $student_data['subject'];
            $student->marks   = $student_data['marks'];
            $student->save();
        }
    }
}
