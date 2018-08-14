<?php

require_once 'elasticsearch/vendor/autoload.php';


$client = Elasticsearch\ClientBuilder::create()->build();;


$tags = [
	'غوشو',
	'سينشي',
	'شينتشي',
	'كودو',
	'ايدوجاجا',
	'كونان',
	'ران',
	'موري',
	'كوجو',
	'كوجورو',
	'ايومي',
	'يوشيدا',
	'ميتسوهيكو',
	'تسوبوراس',
	'جينتا',
	'كوجيما',
	'اي',
	'هايبرا',
	'هيروشي',
	'اجاسا',
	'سونوكو',
	'سوزوكي',
	'ايري',
	'كيساكا',
	'يوساكو',
	'كودو',
	'يوكيكو',
	'هيجي',
	'هاتوري',
	'كازوها',
	'توياما',
	'يوكو',
	'اوكينو',
	'سوميكو',
	'كوباياشي',
	'توموكي',
	'ارايدي',
	'ماكوتو',
	'كيوجوكو',
	'شيزوكا',
	'جيروكيشي',
	'ايسكس',
	'هوندو',
	'ازوسا',
	'اينوموتو',
	'سوبارو',
	'اوكيا',
	'سيرا',
	'ماسومي',
	'شوكيتشي',
	'هانيدا',
	'ساكوراكو',
	'يونيهارا',
	'جوزو',
	'ميجوري',
	'واتارو',
	'تاكيجي',
	'ميواكو',
	'ساتو',
	'شيراتوري',
	'يومي',
	'مياموتو',
	'تشيبا',
	'نايكو',
	'كورودا',
	'راي',
	'فوريا',
	'سكوتش',
	'اكاي',
	'شويتشي',
	'جودي',
	'ستارلنج',
	'جيمس',
	'بلاك',
	'اندري',
	'كامل',
	'كير',
	'هوندو',
	'ايثان',
	'رينا',
	'زعيم',
	'رم',
	'جين',
	'فودكا',
	'فيرموث',
	'بلموت',
	'كرس',
	'كيانتي',
	'كورن',
	'شيري',
	'شيهو',
	'اكيمي',
	'ميانو',
	'ايلينا',
	'اتسوشي',
	'تيكيلا',
	'بيسكو',
	'كينزو',
	'كالفادوس',
	'كوسودا',
	'كايتو',
	'كيد',
	'كوروبا',
	'اكو',
	'جينزو',
	'ناكوموري',
	'تويتشي',
	'جي',
	'اكوكو',
	'هاكوبا',
	'سبايدر',
	'ماري',
	'يوساكو',
	'يوكيكو',
	'كازوها',
	'سونوكو ',
	'هيبارا',
	'متحرين',
	'صغار',
	'كوراساو',
	'بوربون',
	'ماتسودا',
	'منظمة',
	'سوداء',
	'يامامورا',
	'عصابة',
	'العصابة',
	'fbi',
	'cia',
];

if(1==1){
    $params = [
        'index' => 'conan',
        'type' => 'tag',//character
        'body' => [
            'query' => [
                'match_all' => (object)[]
            ]
        ]
    ];
    $client->deleteByQuery($params);

	foreach ($tags as $key)
		$indexed = $client->index([
			'index' => 'conan',
			'type' => 'tag',
			'id' => $key,
			'body' => (object)[
				'clicks' => 0
			]
		]);
}

$characters = [
	[
		'name' => 'سينشي كودو',
		'img' => 'http://www.detectiveconanworld.com/wiki/images/f/f9/Shinichi_Kudo_60px.jpg',
		'desc' => "Main character of the series and Ran's love interest. He was shrunk into a child after being forced to take a poison, called APTX 4869, created by the Black Organization.",
		'clicks' => 0,
	],
	[
		'name' => 'كونان إيدوجاوا',
		'img' => 'http://www.detectiveconanworld.com/wiki/images/9/9e/Conan_Edogawa_60px.jpg',
		'desc' => "Child version of Shinichi Kudo. He's after the Black Organization to regain his original body. The show follows his journey and the different cases he encounters along the way.",
		'clicks' => 0,
	],
	[
		'name' => 'ران موري',
		'img' => 'http://www.detectiveconanworld.com/wiki/images/a/af/Ran_Mouri_60px.jpg',
		'desc' => "Shinichi's childhood friend, and main love interest. She doesn't know Conan's real identity. She's the one taking care of him along with her detective father, Kogoro. She is also skilled in karate.",
		'clicks' => 0,
	],
	[
		'name' => 'كوجورو موري',
		'img' => 'http://www.detectiveconanworld.com/wiki/images/d/d3/Kogoro_Mouri_60px.jpg',
		'desc' => "Private eye and Ran's father. Separated from Eri Kisaki, Ran's mother.",
		'clicks' => 0,
	],
	[
		'name' => 'أيومي يوشيدا',
		'img' => 'http://www.detectiveconanworld.com/wiki/images/8/8d/Ayumi_Yoshida_60px.jpg',
		'desc' => "Member of the Detective Boys. She likes Conan and she considers Haibara like a best friend to her.",
		'clicks' => 0,
	],
	[
		'name' => 'متسهيكو تسوبوراي',
		'img' => 'http://www.detectiveconanworld.com/wiki/images/a/a9/Mitsuhiko_Tsuburaya_60px.jpg',
		'desc' => "Member of the Detective Boys. Has a crush on Ayumi and Haibara. The most intelligent true child in the Detective Boys. He is great when it comes to science and logic.",
		'clicks' => 0,
	],
	[
		'name' => 'جينتا كوجيمي',
		'img' => 'http://www.detectiveconanworld.com/wiki/images/c/c0/Genta_Kojima_60px.jpg',
		'desc' => "Member of the Detective Boys. Has a crush on Ayumi. Always saying he is the leader of Detective Boys. He loves to eat, especially roasted eel on rice.",
		'clicks' => 0,
	],
	[
		'name' => 'آي هايبرا',
		'img' => 'http://www.detectiveconanworld.com/wiki/images/d/db/Ai_Haibara_60px.jpg',
		'desc' => "Member of the Detective Boys and an adult shrunken by APTX 4869. Her former identity was a Black Organization scientist codenamed Sherry, real name Shiho Miyano. She invented APTX 4869.",
		'clicks' => 0,
	],
	[
		'name' => 'هيروشي أجاسا',
		'img' => 'http://www.detectiveconanworld.com/wiki/images/3/3f/Hiroshi_Agasa_60px.jpg',
		'desc' => "Professor who creates gadgets for Conan to use and the best friend of Yusaku Kudo. He was the first to know about Conan's true identity.",
		'clicks' => 0,
	],
	[
		'name' => 'سونوكو سوزوكي',
		'img' => 'http://www.detectiveconanworld.com/wiki/images/c/c6/Sonoko_Suzuki_60px.jpg',
		'desc' => "Ran's best friend. Youngest daughter of the wealthy Suzuki family.",
		'clicks' => 0,
	],
	[
		'name' => 'ايري كيساكي',
		'img' => 'http://www.detectiveconanworld.com/wiki/images/5/50/Eri_Kisaki_60px.jpg',
		'desc' => "Ran's mother, a very successful attorney. Married to, but currently living separately from Kogoro Mouri. She is a friend of Yukiko Kudo from high school.",
		'clicks' => 0,
	],
	[
		'name' => 'يوساكو كودو',
		'img' => 'http://www.detectiveconanworld.com/wiki/images/6/64/Yusaku_Kudo_60px.jpg',
		'desc' => "Shinichi's father. A famous mystery novel author who is well-known in both America and Japan.",
		'clicks' => 0,
	],
	[
		'name' => 'يوكيكو كودو',
		'img' => 'http://www.detectiveconanworld.com/wiki/images/e/eb/Yukiko_Kudo_60px.jpg',
		'desc' => "Shinichi's mother. A retired actress, she can disguise well and can mimic voices without a voice changer, a skill she learned from the deceased magician Toichi Kuroba. She is a close friend of Sharon Vineyard.",
		'clicks' => 0,
	],
	[
		'name' => 'هيجي هاتوري',
		'img' => 'http://www.detectiveconanworld.com/wiki/images/f/f9/Heiji_Hattori_60px.jpg',
		'desc' => "Shinichi's rival detective and best friend from Osaka. Known as Great Detective of the West. He's also a trained Kendo martial artist and the first to deduce Conan's true identity.",
		'clicks' => 0,
	],
	[
		'name' => 'كازوها توياما',
		'img' => 'http://www.detectiveconanworld.com/wiki/images/4/4b/Kazuha_Toyama_60px.jpg',
		'desc' => "Heiji Hattori's best friend since childhood and love interest. She is also a trained Aikido martial artist.",
		'clicks' => 0,
	],
	[
		'name' => 'يوكو أوكينو',
		'img' => 'http://www.detectiveconanworld.com/wiki/images/6/6a/Yoko_Okino_60px.jpg',
		'desc' => "Idol star who is worshiped by Kogoro Mouri.",
		'clicks' => 0,
	],
	[
		'name' => 'سوميكو كوباياشي',
		'img' => 'http://www.detectiveconanworld.com/wiki/images/9/9a/Sumiko_Kobayashi_60px.jpg',
		'desc' => "Conan's homeroom teacher and Ninzaburo Shiratori's girlfriend. Also the self-proclaimed manager of the Detective Boys.",
		'clicks' => 0,
	],
	[
		'name' => 'تومواكي أرايدي',
		'img' => 'http://www.detectiveconanworld.com/wiki/images/a/a0/Tomoaki_Araide_60px.jpg',
		'desc' => "Kogoro's doctor, Teitan school nurse, and a high school basketball coach. He was once impersonated by Vermouth.",
		'clicks' => 0,
	],
	[
		'name' => 'ماكوتو كيوجوكو',
		'img' => 'http://www.detectiveconanworld.com/wiki/images/f/fd/Makoto_Kyogoku_60px.jpg',
		'desc' => "Sonoko Suzuki's boyfriend, and a karate champion that has been admired by Ran.",
		'clicks' => 0,
	],
	[
		'name' => 'شيزوكا هاتوري',
		'img' => 'http://www.detectiveconanworld.com/wiki/images/c/c7/Shizuka_Hattori_60px.jpg',
		'desc' => "Heiji Hattori's mother.",
		'clicks' => 0,
	],
	[
		'name' => 'جيروكيتشي سوزوكو',
		'img' => 'http://www.detectiveconanworld.com/wiki/images/f/fe/Jirokichi_Suzuki_60px.jpg',
		'desc' => "Sonoko's uncle, obsessed with embarrassing and outsmarting the thief, Kaitou Kid.",
		'clicks' => 0,
	],
	[
		'name' => 'إيسكس هوندو',
		'img' => 'http://www.detectiveconanworld.com/wiki/images/f/ff/Eisuke_Hondou_60px.jpg',
		'desc' => "Ran and Sonoko's classmate, whom Conan finds suspicious. He is later discovered to be looking for his sister, Hidemi and wants to follow in the footsteps of his father and sister to be a CIA agent.",
		'clicks' => 0,
	],
	[
		'name' => 'أزوها إينوموتو',
		'img' => 'http://www.detectiveconanworld.com/wiki/images/1/1d/Azusa_Enomoto_60px.jpg',
		'desc' => "A kind worker at the coffee shop that is right under the Mouri Detective Agency, who sometimes has a case that she wants Kogoro to solve.",
		'clicks' => 0,
	],
	[
		'name' => 'سوبارو أوكيا',
		'img' => 'http://www.detectiveconanworld.com/wiki/images/8/80/Subaru_Okiya_60px.jpg',
		'desc' => "FBI agent Shuichi Akai's civilian persona after he faked his death to protect Kir. He lives in Shinichi Kudo's house, sometimes assists the Detective Boys and Conan on cases, and keeps an eye on Haibara.",
		'clicks' => 0,
	],
	[
		'name' => 'ماسومي سيرا',
		'img' => 'http://www.detectiveconanworld.com/wiki/images/c/c7/Masumi_Sera_60px.jpg',
		'desc' => "A high school detective who transfers into Ran and Sonoko's high school class. She is the sister of Shuichi Akai and Shukichi Haneda.",
		'clicks' => 0,
	],
	[
		'name' => 'شوكيتشي هانيدا',
		'img' => 'http://www.detectiveconanworld.com/wiki/images/6/6e/Shukichi_Haneda_60px.jpg',
		'desc' => "Yumi Miyamoto's ex-boyfriend and a professional shogi player. Also the brother of Shuichi Akai and Masumi Sera.",
		'clicks' => 0,
	],
	[
		'name' => 'شاكوراكو يونيهارا',
		'img' => 'http://www.detectiveconanworld.com/wiki/images/e/e3/Sakurako_Yonehara_60px.jpg',
		'desc' => "A housekeeper and Naeko Miike and Kazunobu Chiba's childhood friend.",
		'clicks' => 0,
	],
	[
		'name' => 'جوزو ميجوري',
		'img' => 'http://www.detectiveconanworld.com/wiki/images/4/47/Juzo_Megure_60px.jpg',
		'desc' => "Inspector from the Tokyo Metropolitan Police District.",
		'clicks' => 0,
	],
	[
		'name' => 'واتارو تاكيجي',
		'img' => 'http://www.detectiveconanworld.com/wiki/images/7/76/Wataru_Takagi_60px.jpg',
		'desc' => "Police officer who works with Inspector Megure. Currently involved with Detective Sato.",
		'clicks' => 0,
	],
	[
		'name' => 'ميواكو ساتو',
		'img' => 'http://www.detectiveconanworld.com/wiki/images/5/5f/Miwako_Sato_60px.jpg',
		'desc' => "Female police officer who works with Inspector Megure. Currently involved with Detective Takagi.",
		'clicks' => 0,
	],
	[
		'name' => 'ننزابورو شيراتوري',
		'img' => 'http://www.detectiveconanworld.com/wiki/images/4/4d/Ninzaburo_Shiratori_60px.jpg',
		'desc' => "Police inspector who works with Inspector Megure. Originally Detective Takagi's rival for Detective Sato's affection, he is currently involved with Sumiko Kobayashi.",
		'clicks' => 0,
	],
	[
		'name' => 'يومي مياموتو',
		'img' => 'http://www.detectiveconanworld.com/wiki/images/b/b9/Yumi_Miyamoto_60px.jpg',
		'desc' => "A traffic enforcer and Detective Sato's best friend who is a compulsive tease.",
		'clicks' => 0,
	],
	[
		'name' => 'كازونوبو تشيبا',
		'img' => 'http://www.detectiveconanworld.com/wiki/images/f/f3/Kazunobu_Chiba_60px.jpg',
		'desc' => "Police officer who often works with Inspector Megure. He is Naeko Miike's childhood friend and love interest.",
		'clicks' => 0,
	],
	[
		'name' => 'نايكو ميكي',
		'img' => 'http://www.detectiveconanworld.com/wiki/images/0/0e/Naeko_Miike_60px.jpg',
		'desc' => "A traffic enforcer working with Yumi Miyamoto. She is Kazunobu Chiba's childhood friend and love interest.",
		'clicks' => 0,
	],
	[
		'name' => 'كيوناجا ماتسوموتو',
		'img' => 'http://www.detectiveconanworld.com/wiki/images/d/dc/Kiyonaga_Matsumoto_60px.jpg',
		'desc' => "Senior Superintendent of the Tokyo Metropolitan Police 1st Division and Inspector Megure's superior.",
		'clicks' => 0,
	],
	[
		'name' => 'يوميناجا',
		'img' => 'http://www.detectiveconanworld.com/wiki/images/8/8f/Inspector_Yuminaga_60px.jpg',
		'desc' => "The head inspector of the arson squad and Kogoro Mouri's former superior.",
		'clicks' => 0,
	],
	[
		'name' => 'شنتارو تشاكي',
		'img' => 'http://www.detectiveconanworld.com/wiki/images/1/1e/Shintaro_Chaki_60px.jpg',
		'desc' => "Superintendent of the Tokyo Metropolitan Police 2nd Division and Ginzo Nakamori's superior.",
		'clicks' => 0,
	],
	[
		'name' => 'هيووي كورودا',
		'img' => 'http://www.detectiveconanworld.com/wiki/images/4/42/Hyoue_Kuroda_60px.jpg',
		'desc' => "Superintendent of the Tokyo Metropolitan Police 1st Division and Former Nagano Police Chief.",
		'clicks' => 0,
	],
	[
		'name' => 'هيزو هاتوري',
		'img' => 'http://www.detectiveconanworld.com/wiki/images/e/e7/Heizo_Hattori_60px.jpg',
		'desc' => "Heiji Hattori's father, and a police chief from Osaka Police District.",
		'clicks' => 0,
	],
	[
		'name' => 'جينشيرو تويوما',
		'img' => 'http://www.detectiveconanworld.com/wiki/images/e/ef/Ginshiro_Toyama_60px.jpg',
		'desc' => "Kazuha's father, and a detective from Osaka Police District.",
		'clicks' => 0,
	],
	[
		'name' => 'جورو أوتاكي',
		'img' => 'http://www.detectiveconanworld.com/wiki/images/c/c7/Goro_Otaki_60px.jpg',
		'desc' => "Inspector from Osaka Police District, and a very close friend to Heiji and Heizo.",
		'clicks' => 0,
	],
	[
		'name' => 'كانسوكي ياماتو',
		'img' => 'http://www.detectiveconanworld.com/wiki/images/d/d7/Kansuke_Yamato_60px.jpg',
		'desc' => "Inspector from Nagano Police District, partially disabled after surviving an avalanche.",
		'clicks' => 0,
	],
	[
		'name' => 'يوي ويهارا',
		'img' => 'http://www.detectiveconanworld.com/wiki/images/f/fe/Yui_Uehara_60px.jpg',
		'desc' => "Kansuke Yamato's former partner who has recently returned to the force.",
		'clicks' => 0,
	],
	[
		'name' => 'تكآكي ماروفوشي',
		'img' => 'http://www.detectiveconanworld.com/wiki/images/7/7b/Taka%27aki_Morofushi_60px.jpg',
		'desc' => "Inspector from Nagano Police District. Childhood friend and rival of Kansuke Yamato.",
		'clicks' => 0,
	],
	[
		'name' => 'سانجو يوكوميزو',
		'img' => 'http://www.detectiveconanworld.com/wiki/images/2/21/Sango_Yokomizo_60px.jpg',
		'desc' => "Inspector from Shizuoka Police District, known for his gruff personality.",
		'clicks' => 0,
	],
	[
		'name' => 'ميساو ياماموري',
		'img' => 'http://www.detectiveconanworld.com/wiki/images/4/42/Misao_Yamamura_60px.jpg',
		'desc' => "Detective from Gunma Police District, albeit a not very good one. Is later promoted to Inspector.",
		'clicks' => 0,
	],
	[
		'name' => 'جوغو يوكوميزو',
		'img' => 'http://www.detectiveconanworld.com/wiki/images/6/66/Jugo_Yokomizo_60px.jpg',
		'desc' => "Sango Yokomizo's twin brother, also an inspector from Kanagawa Police District. He is not as easygoing as his brother.",
		'clicks' => 0,
	],
	[
		'name' => 'ري فوريا -باربون',
		'img' => 'http://www.detectiveconanworld.com/wiki/images/1/12/Rei_Furuya_60px.jpg',
		'desc' => "Aka Tooru Amuro. Specializes in detective work and information gathering. He posed as a private detective and became Kogoro Mouri's apprentice. He is later revealed as a undercover Secret Police agent working to undermine the Organization.",
		'clicks' => 0,
	],
	[
		'name' => 'سكوتش',
		'img' => 'http://www.detectiveconanworld.com/wiki/images/c/c4/Scotch_60px.jpg',
		'desc' => "A deceased undercover agent from the Secret Police. He was killed while infiltrating the Black Organization.",
		'clicks' => 0,
	],
	[
		'name' => 'شويتشي أكاي -داي موروبوشي',
		'img' => 'http://www.detectiveconanworld.com/wiki/images/2/22/Shuichi_Akai_60px.jpg',
		'desc' => "FBI agent, considered by Gin as his rival, and the Silver Bullet that could take down the Black Organization. In the past, he infiltrated the Black Organization under the name Dai Moroboshi and obtained the codename Rye before being expelled. He faked his death to protect Kir and is currently undercover as Subaru Okiya.",
		'clicks' => 0,
	],
	[
		'name' => 'جودي ستارلنج',
		'img' => 'http://www.detectiveconanworld.com/wiki/images/8/8c/Jodie_Starling_60px.jpg',
		'desc' => "An FBI agent on an undercover assignment against the Black Organization, and Ran's English teacher at one point. She had been Shuichi Akai's girlfriend before he met Akemi Miyano.",
		'clicks' => 0,
	],
	[
		'name' => 'جيمس بلاك',
		'img' => 'http://www.detectiveconanworld.com/wiki/images/4/4a/James_Black_60px.jpg',
		'desc' => "High ranking FBI agent, Jodie's superior.",
		'clicks' => 0,
	],
	[
		'name' => 'أندري كاميل',
		'img' => 'http://www.detectiveconanworld.com/wiki/images/7/71/Andre_Camel_60px.jpg',
		'desc' => "FBI agent, played a vital role in the protection of Rena Mizunashi.",
		'clicks' => 0,
	],
	[
		'name' => 'هيديمي هوندو -رينا ميزوناشي -كير',
		'img' => 'http://www.detectiveconanworld.com/wiki/images/7/73/Hidemi_Hondou_60px.jpg',
		'desc' => "An undercover CIA agent, also pretending to be TV reporter Rena Mizunashi.",
		'clicks' => 0,
	],
	[
		'name' => 'إيثان هوندو',
		'img' => 'http://www.detectiveconanworld.com/wiki/images/2/2e/Ethan_Hondou_60px.jpg',
		'desc' => "Deceased CIA member who infiltrated the Black Organization. He is also Hidemi and Eisuke's father.",
		'clicks' => 0,
	],
	[
		'name' => 'الزعيم',
		'img' => 'http://www.detectiveconanworld.com/wiki/images/8/8d/The_Boss_of_the_Black_Organization_60px.jpg',
		'desc' => "Deceased CIA member who infiltrated the Black Organization. He is also Hidemi and Eisuke's father.",
		'clicks' => 0,
	],
	[
		'name' => 'رم',
		'img' => 'http://www.detectiveconanworld.com/wiki/images/3/3f/Rum_60px.jpg',
		'desc' => "A high ranking member of the Black Organization, Rum has a close connection to the Boss.",
		'clicks' => 0,
	],
	[
		'name' => 'جين',
		'img' => 'http://www.detectiveconanworld.com/wiki/images/d/d4/Gin_60px.jpg',
		'desc' => "High ranking executive member of the Black Organization. A highly intelligent and lethal assassin, he tried to kill Shinichi with APTX 4869.",
		'clicks' => 0,
	],
	[
		'name' => 'فودكا',
		'img' => 'http://www.detectiveconanworld.com/wiki/images/b/b8/Vodka_60px.jpg',
		'desc' => "Member of the Black Organization. Gin's secretary and partner on most occasions.",
		'clicks' => 0,
	],
	[
		'name' => 'كرس فنيارد -فيرموث',
		'img' => 'http://www.detectiveconanworld.com/wiki/images/b/b2/Vermouth_60px.jpg',
		'desc' => "Member of the Black Organization. She is an actress and master of disguise. Considered the Boss' favorite, and knows that Haibara and Conan are really Sherry and Shinichi.",
		'clicks' => 0,
	],
	[
		'name' => 'كيانتي',
		'img' => 'http://www.detectiveconanworld.com/wiki/images/b/ba/Chianti_60px.jpg',
		'desc' => "Member of the Black Organization. Considered an excellent sniper.",
		'clicks' => 0,
	],
	[
		'name' => 'كورن',
		'img' => 'http://www.detectiveconanworld.com/wiki/images/d/d9/Korn_60px.jpg',
		'desc' => "Member of the Black Organization. Considered an excellent sniper.",
		'clicks' => 0,
	],
	[
		'name' => 'شيهو ميانو -شيري',
		'img' => 'http://www.detectiveconanworld.com/wiki/images/7/75/Shiho_Miyano_60px.jpg',
		'desc' => "Codenamed Sherry, she was a scientist for the Black Organization and creator of APTX 4869. Her sister's death caused her to betray the Black Organization. Her current alias is Ai Haibara.",
		'clicks' => 0,
	],
	[
		'name' => 'أكيمي ميانو',
		'img' => 'http://www.detectiveconanworld.com/wiki/images/7/71/Akemi_Miyano_60px.jpg',
		'desc' => "Former member of the Black Organization, sister of Shiho Miyano, daughter of Elena Miyano and Atsushi Miyano, and the girlfriend of Shuichi Akai. She was killed by Gin for being a liability to the organization.",
		'clicks' => 0,
	],
	[
		'name' => 'إيلينا ميانو',
		'img' => 'http://www.detectiveconanworld.com/wiki/images/1/13/Elena_Miyano_60px.jpg',
		'desc' => "Akemi Miyano and Shiho Miyano's mother. Deceased member of the Black Organization. Known as the Hell's Angel.",
		'clicks' => 0,
	],
	[
		'name' => 'أتسوشي ميانو',
		'img' => 'http://www.detectiveconanworld.com/wiki/images/6/61/Atsushi_Miyano_60px.jpg',
		'desc' => "Akemi Miyano and Shiho Miyano's father. Deceased member of the Black Organization. Known as the Mad Scientist.",
		'clicks' => 0,
	],
	[
		'name' => 'تيكويلا',
		'img' => 'http://www.detectiveconanworld.com/wiki/images/a/ab/Tequila_60px.jpg',
		'desc' => "Member of the Black Organization, originally trying to get programs and a list of the world's top programmers. Accidentally got killed by a bomb.",
		'clicks' => 0,
	],
	[
		'name' => 'كينزو ماسوياما -بيسكو',
		'img' => 'http://www.detectiveconanworld.com/wiki/images/3/33/Pisco_60px.jpg',
		'desc' => "An executive member of the Black Organization and a family friend of the Miyanos. His last assignment was to kill a politician. He was killed by Gin for getting caught in the act.",
		'clicks' => 0,
	],
	[
		'name' => 'كالفادوس',
		'img' => 'http://www.detectiveconanworld.com/wiki/images/6/6a/Calvados_60px.jpg',
		'desc' => "Member of the Black Organization, another sniper. Kills himself after Shuichi Akai disables him. He was in love with Vermouth.",
		'clicks' => 0,
	],
	[
		'name' => 'ريكوميتشي كوسودا',
		'img' => 'http://www.detectiveconanworld.com/wiki/images/7/7f/Rikumichi_Kusuda_60px.jpg',
		'desc' => "Member of the Black Organization, who pretends to be a patient in the hospital holding Kir. He commits suicide when his cover is blown. His corpse is used to fake Shuichi Akai's death.",
		'clicks' => 0,
	],
	[
		'name' => 'كايتو كوروبا',
		'img' => 'http://www.detectiveconanworld.com/wiki/images/9/93/Kaito_Kuroba_60px.jpg',
		'desc' => "High school student and magician. Aoko Nakamori's childhood friend, and love interest. Son of world-renowned magician Toichi Kuroba.",
		'clicks' => 0,
	],
	[
		'name' => 'كايتو كيد',
		'img' => 'http://www.detectiveconanworld.com/wiki/images/d/d1/Kaitou_Kid_60px.jpg',
		'desc' => "Secret identity of Kaito Kuroba. Magician and thief known to be uncatchable.",
		'clicks' => 0,
	],
	[
		'name' => 'آكو ناكاموري',
		'img' => 'http://www.detectiveconanworld.com/wiki/images/1/19/Aoko_Nakamori_60px.jpg',
		'desc' => "Kaito Kuroba's childhood friend, and love interest. Daughter of Ginzo Nakamori.",
		'clicks' => 0,
	],
	[
		'name' => 'جينزو ناكاموري',
		'img' => 'http://www.detectiveconanworld.com/wiki/images/5/50/Ginzo_Nakamori_60px.jpg',
		'desc' => "Inspector from Tokyo Metropolitan Police 2nd Division, who is obsessed with capturing Kaitou Kid.",
		'clicks' => 0,
	],
	[
		'name' => 'تويتشي كوروبا',
		'img' => 'http://www.detectiveconanworld.com/wiki/images/1/12/Toichi_Kuroba_60px.jpg',
		'desc' => "Kaito Kuroba's deceased father. Once a world-renowned magician and the original: Kaitou Kid. He was the one who taught Yukiko Kudo and Sharon Vineyard how to make a perfect disguise.",
		'clicks' => 0,
	],
	[
		'name' => 'تشيكاجي كوروبا',
		'img' => 'http://www.detectiveconanworld.com/wiki/images/6/69/Chikage_Kuroba_60px.jpg',
		'desc' => "Kaito Kuroba's mother. She used to masquerade as the thief Phantom Lady.",
		'clicks' => 0,
	],
	[
		'name' => 'كونوسوكي جي',
		'img' => 'http://www.detectiveconanworld.com/wiki/images/c/cb/Konosuke_Jii_60px.jpg',
		'desc' => "Once Toichi Kuroba's attendant and friend, now Kaito's assistant.",
		'clicks' => 0,
	],
	[
		'name' => 'كايتو كوروبو',
		'img' => 'http://www.detectiveconanworld.com/wiki/images/c/c9/Kaitou_Corbeau_60px.jpg',
		'desc' => "A mysterious thief that looks like Kaitou Kid in black clothing. He recently emerged in Las Vegas before coming to Japan to target the Midnight Crow.",
		'clicks' => 0,
	],
	[
		'name' => 'أكاكو كويزومي',
		'img' => 'http://www.detectiveconanworld.com/wiki/images/4/43/Akako_Koizumi_60px.jpg',
		'desc' => "A witch who wishes to seduce Kaitou Kid and enslave all men.",
		'clicks' => 0,
	],
	[
		'name' => 'ساجورو هاكوبا',
		'img' => 'http://www.detectiveconanworld.com/wiki/images/6/66/Saguru_Hakuba_60px.jpg',
		'desc' => "High school detective trying to catch Kaitou Kid.",
		'clicks' => 0,
	],
	[
		'name' => 'سنيك',
		'img' => 'http://www.detectiveconanworld.com/wiki/images/4/45/Snake_60px.jpg',
		'desc' => "A member of the Magic Kaito Organization who is responsible for murdering Toichi Kuroba.",
		'clicks' => 0,
	],
	[
		'name' => 'سبايدر',
		'img' => 'http://www.detectiveconanworld.com/wiki/images/a/aa/Spider_60px.jpg',
		'desc' => "An anime only character who works for the Magic Kaito Organization as an assassin. His public persona is a stage performer and illusionist named Gunter Von Goldberg II.
",
		'clicks' => 0,
	],
	[
		'name' => 'ماري',
		'img' => 'http://www.detectiveconanworld.com/wiki/images/9/9c/Mary_60px.jpg',
		'desc' => "An unknown child of middle-school age who appears to be a girl with light hair. She is actually a middle-aged woman and the mother of Shuichi Akai, Shukichi Haneda, and Masumi Sera.",
		'clicks' => 0,
	],
	[
		'name' => 'كوهيجي هانيدا',
		'img' => 'http://www.detectiveconanworld.com/wiki/images/b/b4/Kohji_Haneda_60px.jpg',
		'desc' => "Shukichi's non-blood brother and a professional shogi player. He was forced to take a poison, called APTX 4869, created by the Black Organization.",
		'clicks' => 0,
	],
	[
		'name' => 'تسوتومو أكاي',
		'img' => 'http://www.detectiveconanworld.com/wiki/images/c/cf/Tsutomu_Akai_60px.jpg',
		'desc' => "Mary's husband and the father of Shuichi Akai, Shukichi Haneda, and Masumi Sera.",
		'clicks' => 0,
	],
];

if(1==1){
	//todo
	//must delete everything before insetr

	$params = [
	    'index' => 'conan',
	    'type' => 'character',
	    'body' => [
	        'query' => [
	            'match_all' => (object)[]
	        ]
	    ]
	];
	$cccc = $client->deleteByQuery($params);
//echo '<pre style="direction:ltr">',print_r($cccc),'</pre>';	
	foreach ($characters as $key){
		$indexed = $client->index([
			'index' => 'conan',
			'type' => 'character',
			'body' => (object)[
				'clicks' => 0,
				'name' => $key['name'],
				'img'  => $key['img'],
				'desc' => /*translate*/($key['desc'])
			]
		]);
	}
}

if(1==1)
	$params = [
	    'index' => 'conan',
	    'type' => 'post',
	    'body' => [
	        'post' => [
	            '_source' => [
	                'enabled' => true
	            ],
	            'properties' => [
	                'likes' => [
	                    'type' => 'integer'
	                ],
                        'created_time' => [
                            'type' => 'long'
                        ],
			'videos' => [
			    'type' =>' string'
			],
	            ]
	        ]
	    ]
	];
	$cccc = 0;
	try{
		$cccc = $client->indices()->putMapping($params);
	}
	catch(Exception $ex){
		if(isset($_GET['error']))
        		echo '<pre style="direction:ltr">',print_r($ex),'</pre>';
	}
        $params = [
            'index' => 'conan',
            'type' => 'character',
            'body' => [
                'character' => [
                    '_source' => [
                        'enabled' => true
                    ],
                    'properties' => [
                        'clicks' => [
                            'type' => 'integer'
                        ]
                    ]
                ]
            ]
        ];
	$cccc = 0;
	try{
        	$cccc = $client->indices()->putMapping($params);
	}
	catch(Exception $ex){
                if(isset($_GET['error']))
                        echo '<pre style="direction:ltr">',print_r($ex),'</pre>';
	}
