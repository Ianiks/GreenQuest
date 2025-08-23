<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GameController extends Controller
{
    public function wasteSortingQuiz($difficulty = 'easy')
    {
        $questions = [
            'easy' => [
                [
                    'question' => 'Where should you throw a banana peel?',
                    'options' => ['Recyclable', 'Residual', 'Biodegradable', 'Hazardous'],
                    'answer' => 2
                ],
                [
                    'question' => 'Where should a used battery be disposed?',
                    'options' => ['Biodegradable', 'Residual', 'Hazardous', 'Recyclable'],
                    'answer' => 2
                ],
                [
                    'question' => 'What bin should paper go in?',
                    'options' => ['Recyclable', 'Residual', 'Biodegradable', 'Hazardous'],
                    'answer' => 0
                ],
                [
                    'question' => 'Where should broken glass be placed?',
                    'options' => ['Recyclable', 'Residual', 'Biodegradable', 'Hazardous'],
                    'answer' => 3
                ],
                [
                    'question' => 'What should you do with plastic bottles?',
                    'options' => ['Throw in residual', 'Recycle', 'Compost', 'Burn'],
                    'answer' => 1
                ],
                [
                    'question' => 'Where do food scraps belong?',
                    'options' => ['Recyclable', 'Residual', 'Biodegradable', 'Hazardous'],
                    'answer' => 2
                ],
                [
                    'question' => 'How should you dispose of old clothes?',
                    'options' => ['Residual bin', 'Donate if usable', 'Burn them', 'Bury them'],
                    'answer' => 1
                ],
                [
                    'question' => 'What should you do with expired medicines?',
                    'options' => ['Flush down toilet', 'Throw in residual', 'Return to pharmacy', 'Bury'],
                    'answer' => 2
                ],
                [
                    'question' => 'Where should aluminum cans go?',
                    'options' => ['Recyclable', 'Residual', 'Biodegradable', 'Hazardous'],
                    'answer' => 0
                ],
                [
                    'question' => 'How to dispose of cooking oil?',
                    'options' => ['Pour down drain', 'Recycle', 'Store in container and dispose properly', 'Mix with water'],
                    'answer' => 2
                ]
            ],
            'moderate' => [
                [
                    'question' => 'What should you do with pizza boxes with grease stains?',
                    'options' => ['Recycle', 'Compost', 'Residual', 'Hazardous'],
                    'answer' => 2
                ],
                [
                    'question' => 'How to dispose of fluorescent light bulbs?',
                    'options' => ['Regular trash', 'Recycling bin', 'Hazardous waste facility', 'Compost'],
                    'answer' => 2
                ],
                [
                    'question' => 'What to do with plastic bags?',
                    'options' => ['Recycle curbside', 'Take to special collection', 'Residual', 'Burn'],
                    'answer' => 1
                ],
                [
                    'question' => 'Where should pet waste go?',
                    'options' => ['Compost', 'Residual', 'Flush down toilet', 'Bury'],
                    'answer' => 1
                ],
                [
                    'question' => 'How to dispose of broken ceramics?',
                    'options' => ['Recycling', 'Residual', 'Compost', 'Hazardous'],
                    'answer' => 1
                ],
                [
                    'question' => 'What to do with used tissues?',
                    'options' => ['Recycle', 'Compost', 'Residual', 'Hazardous'],
                    'answer' => 2
                ],
                [
                    'question' => 'Where should disposable diapers go?',
                    'options' => ['Recyclable', 'Residual', 'Biodegradable', 'Hazardous'],
                    'answer' => 1
                ],
                [
                    'question' => 'How to dispose of paint cans?',
                    'options' => ['Residual when dry', 'Recycle empty', 'Hazardous if containing paint', 'All of the above'],
                    'answer' => 3
                ],
                [
                    'question' => 'What to do with Styrofoam?',
                    'options' => ['Recycle curbside', 'Special recycling center', 'Residual', 'Burn'],
                    'answer' => 1
                ],
                [
                    'question' => 'How to dispose of electronic waste?',
                    'options' => ['Regular trash', 'Special e-waste facility', 'Burn', 'Bury'],
                    'answer' => 1
                ]
            ],
            'difficult' => [
                [
                    'question' => 'What should you do with shredded paper?',
                    'options' => ['Recycle loose', 'Put in plastic bag first', 'Compost', 'Residual'],
                    'answer' => 0
                ],
                [
                    'question' => 'How to dispose of asbestos materials?',
                    'options' => ['Regular trash', 'Special hazardous waste facility', 'Bury', 'Burn carefully'],
                    'answer' => 1
                ],
                [
                    'question' => 'What to do with mercury thermometers?',
                    'options' => ['Throw in trash', 'Hazardous waste facility', 'Flush down toilet', 'Bury'],
                    'answer' => 1
                ],
                [
                    'question' => 'How to dispose of nuclear waste?',
                    'options' => ['Special disposal facilities', 'Regular trash', 'Bury deep underground', 'Both 1 and 3'],
                    'answer' => 3
                ],
                [
                    'question' => 'What to do with medical sharps?',
                    'options' => ['Throw in trash', 'Flush down toilet', 'Sharps container', 'Burn'],
                    'answer' => 2
                ],
                [
                    'question' => 'How to dispose of lithium batteries?',
                    'options' => ['Regular trash', 'Special recycling', 'Burn', 'Bury'],
                    'answer' => 1
                ],
                [
                    'question' => 'What to do with pesticide containers?',
                    'options' => ['Triple rinse and recycle', 'Throw in trash', 'Burn', 'Bury'],
                    'answer' => 0
                ],
                [
                    'question' => 'How to dispose of radioactive smoke detectors?',
                    'options' => ['Regular trash', 'Return to manufacturer', 'Hazardous waste facility', 'Both 2 and 3'],
                    'answer' => 3
                ],
                [
                    'question' => 'What to do with lead-acid batteries?',
                    'options' => ['Throw in trash', 'Return to retailer', 'Hazardous waste facility', 'Both 2 and 3'],
                    'answer' => 3
                ],
                [
                    'question' => 'How to dispose of industrial chemicals?',
                    'options' => ['Drain carefully', 'Special hazardous waste facility', 'Dilute and pour down drain', 'Evaporate in open air'],
                    'answer' => 1
                ]
            ]
        ];

        $selectedQuestions = $questions[$difficulty] ?? $questions['easy'];
        session()->put('waste_sorting_correct', collect($selectedQuestions)->pluck('answer')->toArray());

        return view('games.waste-sorting-quiz', [
            'questions' => $selectedQuestions,
            'difficulty' => $difficulty
        ]);
    }

    public function ecoPlan($difficulty = 'easy')
    {
        $questions = [
            'easy' => [
                [
                    'question' => 'What is the main gas responsible for global warming?',
                    'options' => ['Oxygen', 'Carbon Dioxide', 'Nitrogen', 'Hydrogen'],
                    'answer' => 1,
                ],
                [
                    'question' => 'Which of these is a renewable energy source?',
                    'options' => ['Coal', 'Wind', 'Oil', 'Natural Gas'],
                    'answer' => 1,
                ],
                [
                    'question' => 'What does "reduce, reuse, recycle" help prevent?',
                    'options' => ['Deforestation', 'Pollution', 'Wildfires', 'Soil Erosion'],
                    'answer' => 1,
                ],
                [
                    'question' => 'Which animal is a key indicator of ocean health?',
                    'options' => ['Dolphin', 'Sea Turtle', 'Coral', 'Shark'],
                    'answer' => 2,
                ],
                [
                    'question' => 'What percentage of Earth\'s water is freshwater?',
                    'options' => ['2.5%', '10%', '25%', '50%'],
                    'answer' => 0,
                ],
                [
                    'question' => 'What is the primary cause of deforestation?',
                    'options' => ['Natural disasters', 'Human activity', 'Climate change', 'Animal grazing'],
                    'answer' => 1,
                ],
                [
                    'question' => 'Which of these helps reduce carbon footprint?',
                    'options' => ['Driving alone', 'Using plastic bags', 'Planting trees', 'Leaving lights on'],
                    'answer' => 2,
                ],
                [
                    'question' => 'What is composting?',
                    'options' => ['Burning waste', 'Recycling plastic', 'Decomposing organic matter', 'Melting metals'],
                    'answer' => 2,
                ],
                [
                    'question' => 'Which is NOT a fossil fuel?',
                    'options' => ['Coal', 'Oil', 'Solar energy', 'Natural gas'],
                    'answer' => 2,
                ],
                [
                    'question' => 'What is the greenhouse effect?',
                    'options' => ['Plants growing in greenhouses', 'Gases trapping heat in atmosphere', 'Using green energy', 'Recycling programs'],
                    'answer' => 1,
                ]
            ],
            'moderate' => [
                [
                    'question' => 'What is the most effective way to reduce plastic pollution?',
                    'options' => ['Recycling', 'Using biodegradable plastics', 'Reducing single-use plastics', 'Burning plastics'],
                    'answer' => 2,
                ],
                [
                    'question' => 'Which country produces the most solar energy?',
                    'options' => ['USA', 'China', 'Germany', 'India'],
                    'answer' => 1,
                ],
                [
                    'question' => 'What is carbon sequestration?',
                    'options' => ['Measuring carbon', 'Storing carbon dioxide', 'Burning carbon', 'Releasing carbon'],
                    'answer' => 1,
                ],
                [
                    'question' => 'Which is a consequence of ocean acidification?',
                    'options' => ['Coral bleaching', 'More fish', 'Cleaner water', 'Increased oxygen'],
                    'answer' => 0,
                ],
                [
                    'question' => 'What is the Paris Agreement about?',
                    'options' => ['Trade', 'Climate change', 'Tourism', 'Education'],
                    'answer' => 1,
                ],
                [
                    'question' => 'Which is NOT a sustainable practice?',
                    'options' => ['Rainwater harvesting', 'Overfishing', 'Crop rotation', 'Organic farming'],
                    'answer' => 1,
                ],
                [
                    'question' => 'What is the main benefit of LED lights?',
                    'options' => ['Brighter light', 'Energy efficiency', 'Higher cost', 'Shorter lifespan'],
                    'answer' => 1,
                ],
                [
                    'question' => 'Which gas is primarily responsible for ozone depletion?',
                    'options' => ['CO2', 'Methane', 'CFCs', 'Nitrogen'],
                    'answer' => 2,
                ],
                [
                    'question' => 'What is ecological footprint?',
                    'options' => ['Shoe size', 'Land area needed to sustain lifestyle', 'Carbon emissions', 'Water usage'],
                    'answer' => 1,
                ],
                [
                    'question' => 'Which is a sustainable transportation method?',
                    'options' => ['Driving alone', 'Flying', 'Public transit', 'Cruise ships'],
                    'answer' => 2,
                ]
            ],
            'difficult' => [
                [
                    'question' => 'What is the Keeling Curve?',
                    'options' => ['Ocean current map', 'CO2 concentration graph', 'Temperature record', 'Species extinction rate'],
                    'answer' => 1,
                ],
                [
                    'question' => 'Which is NOT a UN Sustainable Development Goal?',
                    'options' => ['Clean Water', 'Affordable Energy', 'Space Exploration', 'Climate Action'],
                    'answer' => 2,
                ],
                [
                    'question' => 'What is the albedo effect?',
                    'options' => ['Heat reflection by surfaces', 'Ocean currents', 'Plant photosynthesis', 'Animal migration'],
                    'answer' => 0,
                ],
                [
                    'question' => 'Which is a carbon-negative activity?',
                    'options' => ['Driving a car', 'Flying', 'Biochar production', 'Using coal'],
                    'answer' => 2,
                ],
                [
                    'question' => 'What is blue carbon?',
                    'options' => ['Carbon in atmosphere', 'Carbon stored in oceans', 'Industrial carbon', 'Carbon in rocks'],
                    'answer' => 1,
                ],
                [
                    'question' => 'Which is NOT a climate change mitigation strategy?',
                    'options' => ['Reforestation', 'Carbon capture', 'Deforestation', 'Renewable energy'],
                    'answer' => 2,
                ],
                [
                    'question' => 'What is the main challenge of hydrogen fuel?',
                    'options' => ['Production emissions', 'Abundance', 'Storage', 'Both 1 and 3'],
                    'answer' => 3,
                ],
                [
                    'question' => 'Which is an example of circular economy?',
                    'options' => ['Single-use products', 'Product life extension', 'Landfilling', 'Planned obsolescence'],
                    'answer' => 1,
                ],
                [
                    'question' => 'What is the main cause of biodiversity loss?',
                    'options' => ['Habitat destruction', 'Natural selection', 'Climate cycles', 'Animal migration'],
                    'answer' => 0,
                ],
                [
                    'question' => 'Which is NOT a carbon offset method?',
                    'options' => ['Tree planting', 'Renewable energy projects', 'Methane capture', 'Coal mining'],
                    'answer' => 3,
                ]
            ]
        ];

        $selectedQuestions = $questions[$difficulty] ?? $questions['easy'];
        session()->put('eco_plan_correct', collect($selectedQuestions)->pluck('answer')->toArray());

        return view('games.eco-plan', [
            'questions' => $selectedQuestions,
            'difficulty' => $difficulty
        ]);
    }

    public function trivia($difficulty = 'easy')
    {
        $questions = [
            'easy' => [
                [
                    'question' => 'What is the capital of France?',
                    'options' => ['London', 'Berlin', 'Paris', 'Rome'],
                    'answer' => 2,
                ],
                [
                    'question' => 'Which planet is known as the Red Planet?',
                    'options' => ['Earth', 'Mars', 'Jupiter', 'Venus'],
                    'answer' => 1,
                ],
                [
                    'question' => 'What is H2O commonly known as?',
                    'options' => ['Salt', 'Water', 'Oxygen', 'Hydrogen'],
                    'answer' => 1,
                ],
                [
                    'question' => 'Which language is primarily spoken in Brazil?',
                    'options' => ['Spanish', 'Portuguese', 'French', 'English'],
                    'answer' => 1,
                ],
                [
                    'question' => 'How many continents are there on Earth?',
                    'options' => ['5', '6', '7', '8'],
                    'answer' => 2,
                ],
                [
                    'question' => 'What is the largest ocean on Earth?',
                    'options' => ['Atlantic', 'Indian', 'Arctic', 'Pacific'],
                    'answer' => 3,
                ],
                [
                    'question' => 'Which country is home to the kangaroo?',
                    'options' => ['New Zealand', 'Australia', 'South Africa', 'Brazil'],
                    'answer' => 1,
                ],
                [
                    'question' => 'What is the currency of Japan?',
                    'options' => ['Yuan', 'Won', 'Yen', 'Dollar'],
                    'answer' => 2,
                ],
                [
                    'question' => 'Which of these is NOT a primary color?',
                    'options' => ['Red', 'Blue', 'Green', 'Yellow'],
                    'answer' => 2,
                ],
                [
                    'question' => 'How many days are in a leap year?',
                    'options' => ['365', '366', '364', '367'],
                    'answer' => 1,
                ]
            ],
            'moderate' => [
                [
                    'question' => 'Which element has the chemical symbol "K"?',
                    'options' => ['Potassium', 'Krypton', 'Kryptonite', 'Calcium'],
                    'answer' => 0,
                ],
                [
                    'question' => 'Who painted the Mona Lisa?',
                    'options' => ['Van Gogh', 'Picasso', 'Da Vinci', 'Michelangelo'],
                    'answer' => 2,
                ],
                [
                    'question' => 'What is the largest organ in the human body?',
                    'options' => ['Liver', 'Brain', 'Skin', 'Heart'],
                    'answer' => 2,
                ],
                [
                    'question' => 'Which country invented tea?',
                    'options' => ['India', 'England', 'China', 'Japan'],
                    'answer' => 2,
                ],
                [
                    'question' => 'What is the smallest prime number?',
                    'options' => ['0', '1', '2', '3'],
                    'answer' => 2,
                ],
                [
                    'question' => 'Which planet has the most moons?',
                    'options' => ['Jupiter', 'Saturn', 'Neptune', 'Mars'],
                    'answer' => 1,
                ],
                [
                    'question' => 'Who wrote "Romeo and Juliet"?',
                    'options' => ['Charles Dickens', 'William Shakespeare', 'Jane Austen', 'Mark Twain'],
                    'answer' => 1,
                ],
                [
                    'question' => 'What is the capital of Canada?',
                    'options' => ['Toronto', 'Vancouver', 'Ottawa', 'Montreal'],
                    'answer' => 2,
                ],
                [
                    'question' => 'Which blood type is the universal donor?',
                    'options' => ['A', 'B', 'AB', 'O'],
                    'answer' => 3,
                ],
                [
                    'question' => 'What is the largest desert in the world?',
                    'options' => ['Sahara', 'Arabian', 'Gobi', 'Antarctic'],
                    'answer' => 3,
                ]
            ],
            'difficult' => [
                [
                    'question' => 'Which country has the most time zones?',
                    'options' => ['USA', 'Russia', 'France', 'China'],
                    'answer' => 2,
                ],
                [
                    'question' => 'What is the only mammal capable of true flight?',
                    'options' => ['Flying squirrel', 'Bat', 'Colugo', 'Sugar glider'],
                    'answer' => 1,
                ],
                [
                    'question' => 'Which language has the most native speakers?',
                    'options' => ['English', 'Hindi', 'Spanish', 'Mandarin'],
                    'answer' => 3,
                ],
                [
                    'question' => 'What is the hardest natural substance on Earth?',
                    'options' => ['Gold', 'Iron', 'Diamond', 'Quartz'],
                    'answer' => 2,
                ],
                [
                    'question' => 'Which planet rotates on its side?',
                    'options' => ['Venus', 'Mars', 'Uranus', 'Neptune'],
                    'answer' => 2,
                ],
                [
                    'question' => 'Who discovered penicillin?',
                    'options' => ['Marie Curie', 'Alexander Fleming', 'Louis Pasteur', 'Robert Koch'],
                    'answer' => 1,
                ],
                [
                    'question' => 'What is the only continent without reptiles or snakes?',
                    'options' => ['Australia', 'Antarctica', 'Europe', 'North America'],
                    'answer' => 1,
                ],
                [
                    'question' => 'Which element is liquid at room temperature?',
                    'options' => ['Bromine', 'Mercury', 'Gallium', 'All of the above'],
                    'answer' => 3,
                ],
                [
                    'question' => 'What is the most abundant gas in Earth\'s atmosphere?',
                    'options' => ['Oxygen', 'Carbon Dioxide', 'Nitrogen', 'Argon'],
                    'answer' => 2,
                ],
                [
                    'question' => 'Which country has the longest coastline?',
                    'options' => ['Russia', 'Canada', 'Australia', 'USA'],
                    'answer' => 1,
                ]
            ]
        ];

        $selectedQuestions = $questions[$difficulty] ?? $questions['easy'];
        session()->put('trivia_correct', collect($selectedQuestions)->pluck('answer')->toArray());

        return view('games.trivia', [
            'questions' => $selectedQuestions,
            'difficulty' => $difficulty
        ]);
    }

    public function submitWasteSortingQuiz(Request $request)
    {
        $correctAnswers = session('waste_sorting_correct', []);
        $score = 0;

        foreach ($correctAnswers as $index => $correct) {
            $userAnswer = $request->input("answer_$index");
            if ((int) $userAnswer === (int) $correct) {
                $score++;
            }
        }

        session()->forget('waste_sorting_correct');

        return view('games.result', [
            'score' => $score,
            'total' => count($correctAnswers),
        ]);
    }

    public function submitEcoPlan(Request $request)
    {
        $correctAnswers = session('eco_plan_correct', []);
        $score = 0;

        foreach ($correctAnswers as $index => $correct) {
            $userAnswer = $request->input("answer_$index");
            if ((int) $userAnswer === (int) $correct) {
                $score++;
            }
        }

        session()->forget('eco_plan_correct');

        return view('games.result', [
            'score' => $score,
            'total' => count($correctAnswers),
        ]);
    }

 public function submitTrivia(Request $request)
    {
        $correctAnswers = session('trivia_correct', []);
        $score = 0;
        $difficulty = $request->input('difficulty', 'easy');

        foreach ($correctAnswers as $index => $correct) {
            $userAnswer = $request->input("answer_$index");
            if ((int) $userAnswer === (int) $correct) {
                $score++;
            }
        }

        session()->forget('trivia_correct');

        return view('games.trivia-result', [
            'score' => $score,
            'total' => count($correctAnswers),
            'currentDifficulty' => $difficulty
        ]);
    }
}