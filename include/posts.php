<?php

$blog = [
    "abtMe" => [
        "title" => "About Me!",
        "mainContent" => "<code>Hello world!</code> My name is Sylvia Duarte. I'm an upcoming junior at Washington
        University in St. Louis majoring in Computer Science and Economics. I started my coding journey in 2021 when I, a former aspiring medical student, 
        stared back at my college work, and wished for work that truly excited me. My first lines of code in Java sparked inspiration. I realize now 
        that I enjoy making things. My software development journey was jumpstarted by the simple
        pleasure of conversing with my computer via code and making it do stuff. <br> Now, I'm continously learning more skills to add to my software developing toolkit with the hopes of becoming a 
        full-stack software engineer. My goal when creating software is to create enrinching user experiences so that users, too, can 
        share that sense of wonder that I have creating those experiences.",
        "header1" => "Here's what I know!",
        "header1Content" => "Java, HTML/CSS... More to come! :)",
        "header2" => "My projects:",
        "header2Content" => "None... for now."
    ],
    
    "meal" => [
        "title" => "What I eat in a day (ideally)",
        "quote" => "<em>“If you really want to make a friend, go to someone's house and eat with him… 
        The people who give you their food give you their heart.” – Cesar Chavez.</em>",
        "mainContent" => "I like food. I love these foods in particular. There are the meals I would cook and eat if I had 
        infinite time as a college student. Hope you like the meals! :)",
        "header1" => "Breakfast",
        "header1Content" => "First up on the menu is a delicious <b>cappucino.</b> This is critical. I'm no 
        coffee enthusiast. But I think the Italians got this drink right. It has the right ratio of 
        espresso, milk, and froth. This is a great drink if you appreciate the taste of coffee but long for more than black coffee. This drink made me ask my mother to get me a 
        milk frother for my 17th birthday. <br> What do I eat though? I'm a fan of <b>Cantonese scrambled eggs. </b> If you have time, I'd recommend that you 
        check out the recipe from this <a href= 'https://www.youtube.com/watch?v=ONYflj0I2QI'> YouTube video</a> made by Chinese Cooking Demystified if 
        you have the time. This channel in general has amazing recipes. Tl;dr: this recipe in its most basic form 
        uses a cornstarch slurry (1:1 ratio of cornstarch and water) which helps you get the perfect egg texture. If you use this slurry, 
        you'll never have those dry, gross, hotel breakfast scrambeled eggs again. I didn't even like scrambled eggs before, but 
        this recipe converted me. It's that good. <br> If you insist on a balanced breakfast, you can eat this with a buttered slice of toast (sourdough gang) and with some strawberries.",
        "header2" => "Lunch + Dinner",
        "header2Content" => "I'm going to be real. I don't think there's any discernable difference between these two meal categories other 
        than its timing. I don't believe in lunch and dinner foods. Not sure if that is even a point of contention, but I thought 
        I'd note that here. <br> I love <b>glazed pork belly over rice.</b> It's such a simple yet delicious meal. All you need is pork belly and rice (duh), ginger (adds aroma), and a premade brown 
        braising sauce (I use <a href = 'https://www.amazon.com/Lee-Kum-Kee-Brown-Braising/dp/B004JLHNPQ/ref=sr_1_5_mod_primary_new?crid=21GR1IYVLUALH&keywords=chinese+brown+sauce&qid=1653065820&s=grocery&sbo=RZvfv%2F%2FHxDF%2BO5021pAnSA%3D%3D&sprefix=chinese+brown+sauce%2Cgrocery%2C74&sr=1-5'>
         this one</a>; you can get it at your local Asian market or on Amazon). If you can cook a half-decent scrambled egg (even the hotel ones), you can cook this dish. It's so yummy!",
        "header3" => "Favorite Drink?",
        "header3Content" => "Water! Just kidding lol. I like Diet Coke and lemonade. I'm also coming around on LaCroix at the moment. My favorite flavor is Tangerine. Orange juice is great too, but I am of the opinion that 
        it is a breakfast item. Since I'd already have a cappucino anyway, I rarely get to enjoy a glass of OJ."
    ],
    
    "contact" => [
        "title" => "Contact me!",
        "quote" => "<em>“We, as human beings, learn through sharing and communicating.” – Hugo Reynolds</em>",
        "mainContent" => "Want to share ideas, opportunities, or just want to chat? You can connect with me via LinkedIn or email!"
    ]


    ];

    function getContent () {
        return $blog;
    }

    
function echoContent ($blog) { //blog[id][target]
    foreach ($blog as $key => $post) {
        echo $post[title];
        } 
    }
