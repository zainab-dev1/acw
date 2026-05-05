<?php

namespace Database\Seeders;

use App\Models\AcademicYear;
use App\Models\Activity;
use App\Models\ActivityDetail;
use Illuminate\Database\Seeder;

class ActivityDetailsSeeder extends Seeder
{
    public function run(): void
    {
        $activeYear = AcademicYear::where('is_active', 1)->first();

        // Fallback: if no active year exists, use the latest.
        if (!$activeYear) {
            $activeYear = AcademicYear::orderByDesc('id')->first();
        }

        if (!$activeYear) {
            // Can't seed activities without an academic year.
            return;
        }

        $rows = [
            [
                'number' => '1',
                'time_range' => '8:00 am - 4:00 pm',
                'date' => '2026-05-06',
                'title' => 'Hackathon ; Smart Sustainable Environmental Building',
                'description' => "Are you ready to innovate, collaborate, and build the future?\n\nJoin our Smart Sustainable Building Hackathon, where multidisciplinary teams will design an AI-driven, eco-friendly smart building that integrates engineering, technology, and business innovation.",
                'category' => 'Tech, Sustainable, Engneering, youth, creativity',
                'contact_person' => 'Doaa Alkathiri',
                'contact_email' => 'Doaa.AlKathiri@utas.edu.om',
                'place' => 'Vision Hall',
                'certificate_policy' => 'winners, those who participated',
                'prizes' => 'Cash',
            ],
            [
                'number' => '2',
                'time_range' => '12:00 PM - 12:54 PM',
                'date' => '2026-05-11',
                'title' => 'Cyber Feud Competition',
                'description' => 'A competitive challenge between two teams, where speed and accuracy in answering questions determine the winner. Each team consists of 3 to 4 participants. The competition is divided into two rounds: in each round, two teams compete, and one winning team advances.',
                'category' => 'Tech, youth',
                'contact_person' => 'Ms. Arwa Al Shanfari',
                'contact_email' => 'arwa.alshanfari@utas.edu.om',
                'place' => 'Dhofar Hall',
                'certificate_policy' => 'no',
                'prizes' => 'gifts',
            ],
            [
                'number' => '3',
                'time_range' => '01:00 PM - 01:30 PM',
                'date' => '2026-05-11',
                'title' => 'Poetry & Prose Recitation Competition',
                'description' => 'Voices of Expression—we invite university students to showcase their creativity through original recitations in Arabic or English. Participants must register in advance and submit their written piece during registration, with themes focusing on identity, culture, personal growth, and inspiration. Shortlisted students will be invited to present their work live on stage, and participants will receive prizes and certificates.',
                'category' => 'Creativity, youth',
                'contact_person' => 'Hadia Khalil',
                'contact_email' => 'hadia.khalil@utas.edu.om',
                'place' => 'Dhofar Hall',
                'certificate_policy' => 'winners',
                'prizes' => 'gifts',
            ],
            [
                'number' => '4',
                'time_range' => '9:35 - 9:50',
                'date' => '2026-05-12',
                'title' => 'AI Video Creation Competition',
                'description' => 'The AI Video Making Competition invites students from all departments to creatively explore the power of artificial intelligence through engaging video content. Participants will design and produce short videos using AI tools to present innovative ideas, real-world applications, or futuristic concepts. This competition encourages originality, storytelling, and technical creativity while showcasing how AI can be used to solve problems and shape the future.',
                'category' => 'Tech, Creativity',
                'contact_person' => 'Dr. Suresh Palarimath',
                'contact_email' => 'Suresh.Palarimath@utas.edu.om',
                'place' => 'Dhofar Hall',
                'certificate_policy' => 'winners',
                'prizes' => 'gifts',
            ],
            [
                'number' => '5',
                'time_range' => '10:00 - 10:15',
                'date' => '2026-05-12',
                'title' => 'TV Presenter Competition',
                'description' => 'تدعو جامعة التقنية والعلوم التطبيقية – فرع صلالة طلبتها للمشاركة في مسابقة “أفضل مذيع”، وذلك بهدف اكتشاف المواهب الإعلامية وتنمية مهارات التقديم التلفزيوني.',
                'category' => 'Creativity, youth',
                'contact_person' => 'Dr. Nawal Mohamed Salaheldin',
                'contact_email' => 'drnawal@utas.edu.om',
                'place' => 'Dhofar Hall',
                'certificate_policy' => 'winners',
                'prizes' => 'gifts',
            ],
            [
                'number' => '6',
                'time_range' => '10:15 - 10:30',
                'date' => '2026-05-12',
                'title' => 'THE STACK MASTERS CHALLENGE: A Test of Skill and Teamwork',
                'description' => 'A game of speed with ingenuity and skills. With teamwork and competencies, the group must build the highest but safe stacked blocks within a specified period of time. They should stack-up the blocks the highest they could but in an artistic and imaginative way that will satisfy the requirement for design and creativity.',
                'category' => 'Creativity, Engineering',
                'contact_person' => 'Ar. Sean Villegas Andres; Er. Anna May Tayo',
                'contact_email' => 'Sean.Andres@utas.edu.om; Anna.May.Tayo@utas.edu.om',
                'place' => 'Dhofar Hall',
                'certificate_policy' => 'no',
                'prizes' => 'gifts',
            ],
            [
                'number' => '7',
                'time_range' => '10:00 - 12:00',
                'date' => '2026-05-12',
                'title' => 'Best Business Idea Competition',
                'description' => "The “Best Project Idea” Competition is designed to foster creativity, innovation, and an entrepreneurial mindset among students across the academic departments of UTAS-Salalah.\n\nTeam selection will be initially conducted by the course tutors of Entrepreneurship classes, covering 13 sections in the current Semester 2, AY 2025–2026. One team from each section will be shortlisted to participate in the competition.\n\nThe selected teams will then develop and present their innovative project ideas through a Concept Board and a Prototype.",
                'category' => 'Creativity, Sustainable',
                'contact_person' => 'Dr. Neil Raymond Saletrero',
                'contact_email' => 'Neil.Saletrero@utas.edu.om',
                'place' => 'Vision Hall',
                'certificate_policy' => 'winners, those who participated',
                'prizes' => 'gifts',
            ],
            [
                'number' => '8',
                'time_range' => '12:00 - 2:00 pm',
                'date' => '2026-05-12',
                'title' => 'Capture The Flag (CTF)',
                'description' => 'A cybersecurity competition where participants solve various security challenges such as cryptography, network analysis, and file forensics. Each solved challenge rewards the participant with a “flag,” proving successful completion.',
                'category' => 'Tech, Creativity',
                'contact_person' => 'Mr. Mohammed Saleem Bhatt',
                'contact_email' => 'saleem@utas.edu.om',
                'place' => 'D103 - Cyber security lab',
                'certificate_policy' => 'winners, those who participated',
                'prizes' => 'gifts',
            ],
            [
                'number' => '9',
                'time_range' => 'all exhibition day',
                'date' => '2026-05-11',
                'title' => 'Crime scene',
                'description' => 'A case-based investigative competition where participants analyze digital evidence to uncover hidden information and solve a simulated cybercrime scenario. This challenge highlights the importance of digital footprints and forensic analysis in modern investigations.',
                'category' => 'Tech, Creativity',
                'contact_person' => 'Ms. Arwa Al Shanfari',
                'contact_email' => 'arwa.alshanfari@utas.edu.om',
                'place' => 'Exhibition hall',
                'certificate_policy' => 'no',
                'prizes' => 'gifts',
            ],
            [
                'number' => '10',
                'time_range' => '12:00 - 2:00',
                'date' => '2026-05-12',
                'title' => 'Competitive Programming Competition',
                'description' => 'A coding competition where participants solve algorithmic and logical problems using Python, focusing on efficiency and correctness. It encourages structured thinking, optimized coding, and real-time problem-solving under time constraints.',
                'category' => 'Tech, Creativity',
                'contact_person' => 'Mr. Muni Balaji Thumu',
                'contact_email' => 'muni.balaji@utas.edu.om',
                'place' => 'BSIT 17L - BSIT 20L',
                'certificate_policy' => 'winners, those who participated',
                'prizes' => 'gifts',
            ],
        ];

        foreach ($rows as $row) {
            $activity = Activity::firstOrCreate(
                [
                    'academic_year_id' => $activeYear->id,
                    'title' => $row['title'],
                    'training_date' => $row['date'],
                ],
                [
                    // Default type (can be changed later through admin UI)
                    'survey_type_id' => 1,
                    'location' => $row['place'],
                ]
            );

            ActivityDetail::updateOrCreate(
                ['activity_id' => $activity->id],
                [
                    'number' => $row['number'],
                    'time_range' => $row['time_range'],
                    'description' => $row['description'],
                    'category' => $row['category'],
                    'contact_person' => $row['contact_person'],
                    'contact_email' => $row['contact_email'],
                    'place' => $row['place'],
                    'certificate_policy' => $row['certificate_policy'],
                    'prizes' => $row['prizes'],
                ]
            );
        }
    }
}
