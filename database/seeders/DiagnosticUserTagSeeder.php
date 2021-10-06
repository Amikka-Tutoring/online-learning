<?php

namespace Database\Seeders;

use App\Models\DiagnosticUserTag;
use Illuminate\Database\Seeder;

class DiagnosticUserTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $istj_learend = ['ISTJs enjoy order and organization in all areas of their lives including their work, family, and school', 'ISTJs are planners. They like to have things planned out well in advance.', 'ISTJs may find themselves unable to rest until they have everything organized and their work for the day has been completed.
', 'ISTJs take a logical approach to achieving goals and are usually motivated in taking steps towards those goals.', 'ISTJs prefer to follow rules and procedures than create their own.'];
        $istj_plan = ['Based on your personality type we will give you personalized recommendations throughout the course to maximize your learning.', 'If you decide to work with a 1-on-1 tutor, we will pair you with a tutor with a compatible personality so that learning becomes easier and more comfortable.'];
        DiagnosticUserTag::create([
            'title' => 'ISTJ',
            'summary' => 'Based on your results we have found that you have an ISTJ personality type. Below we will describe exactly what that means for your course.',
            'learned' => serialize($istj_learend),
            'plan' => serialize($istj_plan),
            'tips' => ''
        ]);
        DiagnosticUserTag::create([
            'title' => 'ISFJ',
            'summary' => 'Based on your results we have found that you have an ISFJ personality type. Below we will describe exactly what that means for your course.',
            'learned' => serialize(['ISFJs tend to be reserved, responsible, and caring.', 'ISFJs are good at remembering details about other topics.', 'ISFJs learn best in a highly structured environment where they are given instructions and clear expectations.', 'ISFJs are more interested in topics when they can see how they are relevant in solving real - world problems.']),
            'plan' => serialize($istj_plan),
            'tips' => ''
        ]);
        DiagnosticUserTag::create([
            'title' => 'INFJ',
            'summary' => 'Based on your results we have found that you have an INFJ personality type . Below we will describe exactly what that means for your course . ',
            'learned' => serialize(['INFJs enjoy thinking about deep topics and contemplating the meaning of life.',
                'INFJs like to exert control by planning, organizing and making decisions as early as possible.',
                'INFJs can be perfectionists at times and tend to put a great deal of effort into their work.']),
            'plan' => serialize($istj_plan),
            'tips' => ''
        ]);
        DiagnosticUserTag::create([
            'title' => 'INTJ',
            'summary' => 'Based on your results we have found that you have an INTJ personality type . Below we will describe exactly what that means for your course . ',
            'learned' => serialize(['INTJs tend to be introverted and prefer to work alone.',
                'INTJs like their world to feel controlled and ordered so they prefer to make plans well in advance.',
                'INTJs are good at gathering information from the outside world, analyzing it and reaching new insights.',
                'INTJs look at the big picture and prefer to focus on abstract information rather than concrete details.']),
            'plan' => serialize($istj_plan),
            'tips' => ''
        ]);
        DiagnosticUserTag::create([
            'title' => 'ISTP',
            'summary' => 'Based on your results we have found that you have an ISTP personality type . Below we will describe exactly what that means for your course . ',
            'learned' => serialize(['ISTPs love hands-on activities and the freedom to work at their own pace.',
                'ISTPs enjoy taking things apart just to see how they work because they are logical and rational.',
                'ISTPs love doing new things and can become bored with routines quickly.',
                'ISTPs learn by experience.']),
            'plan' => serialize($istj_plan),
            'tips' => ''
        ]);
        DiagnosticUserTag::create([
            'title' => 'ISFP',
            'summary' => 'Based on your results we have found that you have an ISFP personality type . Below we will describe exactly what that means for your course . ',
            'learned' => serialize(['ISFPs have an easy-going attitude and tend to accept other people as they are.',
                'ISFPs like to focus on the details. They spend more time thinking about current problems and solutions rather than about the future.',
                'ISFPs tend to be "doers" rather than "thinkers".',
                'ISFPs are friendly but they typically need to get to know you well before they open up.']),
            'plan' => serialize($istj_plan),
            'tips' => ''
        ]);
        DiagnosticUserTag::create([
            'title' => 'INFP',
            'summary' => 'Based on your results we have found that you have an INFP personality type . Below we will describe exactly what that means for your course . ',
            'learned' => serialize(['INFPs tend to be introverted, creative and driven by personal values.',
                'INFPS spend a lot of time exploring their own purpose in life and care about serving humanity to the best of their ability.',
                'INFPs typically rely on intuition and are more focused on the big picture problem or solution.',
                'INFPs work well alone.']),
            'plan' => serialize($istj_plan),
            'tips' => ''
        ]);
        DiagnosticUserTag::create([
            'title' => 'INTP',
            'summary' => 'Based on your results we have found that you have an INTP personality type . Below we will describe exactly what that means for your course . ',
            'learned' => serialize(['INTPs are often described as quiet and analytical.',
                'INTPs are also reserved and thoughtful. They enjoy working alone and coming up with solutions to complex problems.',
                'Tends to be flexible and good at thinking "outside of the box."']),
            'plan' => serialize($istj_plan),
            'tips' => ''
        ]);
        DiagnosticUserTag::create([
            'title' => 'ESTP',
            'summary' => 'Based on your results we have found that you have an ESTP personality type . Below we will describe exactly what that means for your course . ',
            'learned' => serialize(['ESTPs don\'t like excessive planning. They prefer to improvise.',
                'ESTPs make decisions quickly and have strong social skills.',
                'ESTPs prefer straightforward information that they can work with immediately over abstract theories.',
                'ESTPs can be impulsive at times and risk-taking due to the fact that they prefer to improvise.']),
            'plan' => serialize($istj_plan),
            'tips' => ''
        ]);
        DiagnosticUserTag::create([
            'title' => 'ESFP',
            'summary' => 'Based on your results we have found that you have an ESFP personality type . Below we will describe exactly what that means for your course . ',
            'learned' => serialize(['ESFPs tend to be very practical and prefer to learn through hands-on experience.',
                'ESFPs may struggle in traditional classroom settings . However, they do well in situations where they are allowed to work with others or learn through direct experience . ',
                'ESFPs will often rush into a new situation and figure things out as they happen . ',
                'ESFPs tend to dislike routine and are always looking for a new adventure.']),
            'plan' => serialize($istj_plan),
            'tips' => ''
        ]);
        DiagnosticUserTag::create([
            'title' => 'ENTP',
            'summary' => 'Based on your results we have found that you have an ENTP personality type . Below we will describe exactly what that means for your course . ',
            'learned' => serialize(['ENTPs are often described as innovative and expressive.',
                'ENTPs are more interested in ideating and coming up with theories than in nitty gritty details.',
                'ENTPs are great conversationalists and love to engage other people in friendly debates.',
                'ENTPs quickly arrive at conclusions when they recieve new information.']),
            'plan' => serialize($istj_plan),
            'tips' => ''
        ]);
        DiagnosticUserTag::create([
            'title' => 'ESTJ',
            'summary' => 'Based on your results we have found that you have an ESTJ personality type . Below we will describe exactly what that means for your course . ',
            'learned' => serialize(['ESTJs have take-charge attitude and do well in leadership positions.',
                'ESTJs are good at putting plans into action but they sometimes appear critical and slightly aggressive.',
                'ESTJs tend to be very frank and honest when it comes to sharing their opinions.',
                'ESTJs rely on objective information and logic to make decisions ovrer than personal feelings.']),
            'plan' => serialize($istj_plan),
            'tips' => ''
        ]);
        DiagnosticUserTag::create([
            'title' => 'ESFJ',
            'summary' => 'Based on your results we have found that you have an ESFJ personality type . Below we will describe exactly what that means for your course . ',
            'learned' => serialize(['ESFJs have a way of encouraging other people to be their best.',
                'ESFJs expect their kind and giving ways to be noticed and appreciated by others',
                'ESFJs have a strong desire to control their environment. Organizing, planning, and scheduling help people with this personality type feel in control.',
                'ESFJs prefer concrete and immediate details over abstract and theoretical information.']),
            'plan' => serialize($istj_plan),
            'tips' => ''
        ]);
        DiagnosticUserTag::create([
            'title' => 'ENFJ',
            'summary' => 'Based on your results we have found that you have an ENFJ personality type . Below we will describe exactly what that means for your course . ',
            'learned' => serialize(['ENFJs are often perceived as being the "people person."',
                'ENFJs are great at encouraging other people and derive satisfaction from helping others.',
                'ENFJs have a tendency to be too hard on themselves.',
                'ENFJs are good at bringing consensus among large groups . for this reason, they can be great leaders.']),
            'plan' => serialize($istj_plan),
            'tips' => ''
        ]);
        DiagnosticUserTag::create([
            'title' => 'ENTJ',
            'summary' => 'Based on your results we have found that you have an ENTJ personality type . Below we will describe exactly what that means for your course . ',
            'learned' => serialize(['ENTJs have strong verbal skills and interacting with others helps them feel energized.',
                'ENTJs prefer to think about the future rather than focus on the current day.',
                'ENTJs are planners.',
                'ENTJs tend to make snap judgments. They are focused on imposing order and standards on the world around them based on the information they have at hand in the current moment.']),
            'plan' => serialize($istj_plan),
            'tips' => ''
        ]);
        DiagnosticUserTag::create([
            'title' => 'ENFP',
            'summary' => 'Based on your results we have found that you have an ENFP personality type . Below we will describe exactly what that means for your course . ',
            'learned' => serialize(['ENFPs are creative and do best in situations where they have the freedom to be creative.',
                'ENFPs have excellent people skills.',
                'ENFPs strongly dislike routine and prefer to focus on the future. However they sometimes put off important tasks until the last minute.',
                'ENFPs are spontaneous and highly adaptable to change.']),
            'plan' => serialize($istj_plan),
            'tips' => ''
        ]);

    }
}
