<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\Scroll;

use App\Entity\Reponse;
use App\Entity\Question;
use App\Entity\Categorie;
use App\Entity\TypeProfil;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    private $passwordEncoder;
    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;

    }
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
        
        //création des catégories:
        $consommation = new Categorie();
        $consommation->setNom("consommation");
        $consommation->setDescription("La consommation est la catégorie qui concerne à la fois la fréquence des achats, leur nécessité et leur type.");
        $manager->persist($consommation);

        $deplacements = new Categorie();
        $deplacements->setNom("deplacements");
        $deplacements->setDescription("Les déplacements de l'utilisateur sont-ils tous nécessaires ? Utilise-t-il les meilleurs moyens de transport ? Les meilleures routes ?");
        $manager->persist($deplacements);

        $diy = new Categorie();
        $diy->setNom("diy");
        $diy->setDescription("L'utilisateur doit prendre conscience que nombre de produits industriels sont superflus, qu'il peut économiser du temps, de l'argent et du CO2 en faisant quelques simples gestes");
        $manager->persist($diy);

        //Creation des types de profils
        $hermione = new TypeProfil();
        $hermione->setNom("Hermione");
        $hermione->setDescription("It looks like you have already figured it out ! Keep up with the good work and enjoy our tips and functionalities");
        $manager->persist($hermione);

        $ron = new TypeProfil();
        $ron->setNom("Ron");
        $ron->setDescription("It looks like you could use some tips on how to move around in a more sustainable way. Welcome to SemperVirens!");
        $manager->persist($ron);

        $hedwige = new TypeProfil();
        $hedwige->setNom("Hedwige");
        $hedwige->setDescription("Impressive, but maybe we can help you with some diy tips and tricks ? Welcome !");
        $manager->persist($hedwige);

        $harry = new TypeProfil();
        $harry->setNom("Harry");
        $harry->setDescription("Good start, but we can give you some advice and exercices to help you reduce your consumption.");
        $manager->persist($harry);

        $draco = new TypeProfil();
        $draco->setNom("Draco");
        $draco->setDescription("It looks like you really could use a fresh start with... everything? Let's make it happend, you can do it !");
        $manager->persist($draco);

        $luna = new TypeProfil();
        $luna->setNom("Luna");
        $luna->setDescription("Your DIY skills are on top ! Let's guide you with your travel and consumption !");
        $manager->persist($luna);

        $neville = new TypeProfil();
        $neville->setNom("Neville");
        $neville->setDescription("Good news is, we can tell you are off a good start, consumming as little as you do. Now, let's work on your travels and diy !");
        $manager->persist($neville);

        $sirius = new TypeProfil();
        $sirius->setNom("Sirius");
        $sirius->setDescription("It looks like you don't move around too much, but maybe we can also help you consume less and less industrial !");
        $manager->persist($sirius);


        //Création des questions
        $question0= new Question();
        $question0->setTexte("How often would you say you go shopping for clothes ?");
        $question0->setCategorie($consommation);

        $reponse0= new Reponse();
        $reponse0->setTexte("You are addicted to shopping");
        $reponse0->setPoints(0);
        $reponse0->setQuestion($question0);

        $reponse1= new Reponse();
        $reponse1->setTexte("You enjoy the occasionnal shopping spree");
        $reponse1->setPoints(1);
        $reponse1->setQuestion($question0);

        $reponse2= new Reponse();
        $reponse2->setTexte("You only ever buy what you need");
        $reponse2->setPoints(2);
        $reponse2->setQuestion($question0);

        $reponse3= new Reponse();
        $reponse3->setTexte("You try not to buy any new clothes");
        $reponse3->setPoints(3);
        $reponse3->setQuestion($question0);

        $manager->persist($question0);
        $manager->persist($reponse0);
        $manager->persist($reponse1);
        $manager->persist($reponse2);
        $manager->persist($reponse3);
        

        $question1= new Question();
        $question1->setTexte("When it comes to shopping, you'd rather:");
        $question1->setCategorie($consommation);

        $reponse4= new Reponse();
        $reponse4->setTexte("Go in big stores - the cheapest the better of course");
        $reponse4->setPoints(0);
        $reponse4->setQuestion($question1);

        $reponse5= new Reponse();
        $reponse5->setTexte("pay a little bit more if it lasts a little bit longer");
        $reponse5->setPoints(1);
        $reponse5->setQuestion($question1);

        $reponse6= new Reponse();
        $reponse6->setTexte("local and sustainable shops");
        $reponse6->setPoints(2);
        $reponse6->setQuestion($question1);

        $reponse7= new Reponse();
        $reponse7->setTexte("second hands clothes are everything");
        $reponse7->setPoints(3);
        $reponse7->setQuestion($question1);

        $manager->persist($question1);
        $manager->persist($reponse4);
        $manager->persist($reponse5);
        $manager->persist($reponse6);
        $manager->persist($reponse7);


        


        $question2= new Question();
        $question2->setTexte("All your shopping is made:");
        $question2->setCategorie($consommation);

        $reponse8= new Reponse();
        $reponse8->setTexte("online");
        $reponse8->setPoints(0);
        $reponse8->setQuestion($question2);

        $reponse9= new Reponse();
        $reponse9->setTexte("in stores");
        $reponse9->setPoints(1);
        $reponse9->setQuestion($question2);

        $reponse10= new Reponse();
        $reponse10->setTexte("online from second-hand websites");
        $reponse10->setPoints(2);
        $reponse10->setQuestion($question2);

        $reponse11= new Reponse();
        $reponse11->setTexte("in other people's dressing, duh");
        $reponse11->setPoints(3);
        $reponse11->setQuestion($question2);

        $manager->persist($question2);
        $manager->persist($reponse8);
        $manager->persist($reponse9);
        $manager->persist($reponse10);
        $manager->persist($reponse11);

        $question3= new Question();
        $question3->setTexte("About your grocery shopping:");
        $question3->setCategorie($consommation);
        
        $reponse12= new Reponse();
        $reponse12->setTexte("hyper and supermarket are just more convenient for you");
        $reponse12->setPoints(0);
        $reponse12->setQuestion($question3);

        $reponse13= new Reponse();
        $reponse13->setTexte("you only buy from the small local shop around the corner");
        $reponse13->setPoints(1);
        $reponse13->setQuestion($question3);

        $reponse14= new Reponse();
        $reponse14->setTexte("you buy from the local market, checking where it comes from first");
        $reponse14->setPoints(2);
        $reponse14->setQuestion($question3);

        $reponse15= new Reponse();
        $reponse15->setTexte("you only buy from local/bio/no wrap stores");
        $reponse15->setPoints(3);
        $reponse15->setQuestion($question3);
        
        $manager->persist($question3);
        $manager->persist($reponse12);
        $manager->persist($reponse13);
        $manager->persist($reponse14);
        $manager->persist($reponse15);

        $question4= new Question();
        $question4->setTexte("Pick your meal's champion:");
        $question4->setCategorie($consommation);

        $reponse16= new Reponse();
        $reponse16->setTexte("avocado ! Good, healthy, yummy avocado!");
        $reponse16->setPoints(0);
        $reponse16->setQuestion($question4);

        $reponse17= new Reponse();
        $reponse17->setTexte("oranges, for the vitamines and sweetness of life");
        $reponse17->setPoints(1);
        $reponse17->setQuestion($question4);

        $reponse18= new Reponse();
        $reponse18->setTexte("belgian strawberries!");
        $reponse18->setPoints(2);
        $reponse18->setQuestion($question4);

        $reponse19= new Reponse();
        $reponse19->setTexte("anything, as long as it's that time of the year");
        $reponse19->setPoints(3);
        $reponse19->setQuestion($question4);
        
        $manager->persist($question4);
        $manager->persist($reponse16);
        $manager->persist($reponse17);
        $manager->persist($reponse18);
        $manager->persist($reponse19);

        $question5= new Question();
        $question5->setTexte("Your go-to meat would be:");
        $question5->setCategorie($consommation);

        $reponse20= new Reponse();
        $reponse20->setTexte("beeeeeeeeeef");
        $reponse20->setPoints(0);
        $reponse20->setQuestion($question5);

        $reponse21= new Reponse();
        $reponse21->setTexte("fish");
        $reponse21->setPoints(1);
        $reponse21->setQuestion($question5);

        $reponse22= new Reponse();
        $reponse22->setTexte("chicken");
        $reponse22->setPoints(2);
        $reponse22->setQuestion($question5);

        $reponse23= new Reponse();
        $reponse23->setTexte("tofu");
        $reponse23->setPoints(3);
        $reponse23->setQuestion($question5);
        
        $manager->persist($question5);
        $manager->persist($reponse20);
        $manager->persist($reponse21);
        $manager->persist($reponse22);
        $manager->persist($reponse23);

        $question6= new Question();
        $question6->setTexte("Do you check how your cosmetics are made ?");
        $question6->setCategorie($consommation);
        
        $reponse24= new Reponse();
        $reponse24->setTexte("No");
        $reponse24->setPoints(0);
        $reponse24->setQuestion($question6);

        $reponse25= new Reponse();
        $reponse25->setTexte("Sometimes");
        $reponse25->setPoints(1);
        $reponse25->setQuestion($question6);

        $reponse26= new Reponse();
        $reponse26->setTexte("Often");
        $reponse26->setPoints(2);
        $reponse26->setQuestion($question6);

        $reponse27= new Reponse();
        $reponse27->setTexte("Always");
        $reponse27->setPoints(3);
        $reponse27->setQuestion($question6);
        
        $manager->persist($question6);
        $manager->persist($reponse24);
        $manager->persist($reponse25);
        $manager->persist($reponse26);
        $manager->persist($reponse27);

        $question7= new Question();
        $question7->setTexte("What kind of beauty products do you use ?");
        $question7->setCategorie($consommation);
        
        $reponse28= new Reponse();
        $reponse28->setTexte("Luxury brands, only the best for my skin");
        $reponse28->setPoints(0);
        $reponse28->setQuestion($question7);

        $reponse29= new Reponse();
        $reponse29->setTexte("I mostly buy what people tell me to buy");
        $reponse29->setPoints(1);
        $reponse29->setQuestion($question7);

        $reponse30= new Reponse();
        $reponse30->setTexte("I try to use only vegetals oils and natural products");
        $reponse30->setPoints(2);
        $reponse30->setQuestion($question7);

        $reponse31= new Reponse();
        $reponse31->setTexte("Beauty what now ? I am already beautiful");
        $reponse31->setPoints(3);
        $reponse31->setQuestion($question7);
        
        $manager->persist($question7);
        $manager->persist($reponse28);
        $manager->persist($reponse29);
        $manager->persist($reponse30);
        $manager->persist($reponse31);

        $question8= new Question();
        $question8->setTexte("You make all your shopping with:");
        $question8->setCategorie($deplacements);
        
        $reponse32= new Reponse();
        $reponse32->setTexte("Your car");
        $reponse32->setPoints(0);
        $reponse32->setQuestion($question8);

        $reponse33= new Reponse();
        $reponse33->setTexte("Public transportation");
        $reponse33->setPoints(1);
        $reponse33->setQuestion($question8);

        $reponse34= new Reponse();
        $reponse34->setTexte("Your bike");
        $reponse34->setPoints(2);
        $reponse34->setQuestion($question8);

        $reponse35= new Reponse();
        $reponse35->setTexte("I like to walk everywhere");
        $reponse35->setPoints(3);
        $reponse35->setQuestion($question8);
        
        $manager->persist($question8);
        $manager->persist($reponse32);
        $manager->persist($reponse33);
        $manager->persist($reponse34);
        $manager->persist($reponse35);


        $question9= new Question();
        $question9->setTexte("Most of the time, if you're in a car, you are:");
        $question9->setCategorie($deplacements);
        
        $reponse36= new Reponse();
        $reponse36->setTexte("Alone");
        $reponse36->setPoints(0);
        $reponse36->setQuestion($question9);

        $reponse37= new Reponse();
        $reponse37->setTexte("With families or friends");
        $reponse37->setPoints(1);
        $reponse37->setQuestion($question9);

        $reponse38= new Reponse();
        $reponse38->setTexte("Carpooling");
        $reponse38->setPoints(2);
        $reponse38->setQuestion($question9);

        $reponse39= new Reponse();
        $reponse39->setTexte("I don't use/own a car");
        $reponse39->setPoints(3);
        $reponse39->setQuestion($question9);
        
        $manager->persist($question9);
        $manager->persist($reponse36);
        $manager->persist($reponse37);
        $manager->persist($reponse38);
        $manager->persist($reponse39);

        $question10= new Question();
        $question10->setTexte("You usually go on holidays using:");
        $question10->setCategorie($deplacements);
        
        $reponse40= new Reponse();
        $reponse40->setTexte("Airplane");
        $reponse40->setPoints(0);
        $reponse40->setQuestion($question10);

        $reponse41= new Reponse();
        $reponse41->setTexte("Car");
        $reponse41->setPoints(1);
        $reponse41->setQuestion($question10);

        $reponse42= new Reponse();
        $reponse42->setTexte("Public Transport");
        $reponse42->setPoints(2);
        $reponse42->setQuestion($question10);

        $reponse43= new Reponse();
        $reponse43->setTexte("Thank you for reminding me I never go on holiday");
        $reponse43->setPoints(3);
        $reponse43->setQuestion($question10);
        
        $manager->persist($question10);
        $manager->persist($reponse40);
        $manager->persist($reponse41);
        $manager->persist($reponse42);
        $manager->persist($reponse43);

        $question11= new Question();
        $question11->setTexte("If I say 'homemade toothpaste', you think:");
        $question11->setCategorie($diy);
        
        $reponse44= new Reponse();
        $reponse44->setTexte("No, thank you");
        $reponse44->setPoints(0);
        $reponse44->setQuestion($question11);

        $reponse45= new Reponse();
        $reponse45->setTexte("Is it tasty ?");
        $reponse45->setPoints(1);
        $reponse45->setQuestion($question11);

        $reponse46= new Reponse();
        $reponse46->setTexte("Is it efficient ?");
        $reponse46->setPoints(2);
        $reponse46->setQuestion($question11);

        $reponse47= new Reponse();
        $reponse47->setTexte("That's what I already use");
        $reponse47->setPoints(3);
        $reponse47->setQuestion($question11);
        
        $manager->persist($question11);
        $manager->persist($reponse44);
        $manager->persist($reponse45);
        $manager->persist($reponse46);
        $manager->persist($reponse47);

        $question12= new Question();
        $question12->setTexte("If i say 'vinegar', you think:");
        $question12->setCategorie($diy);
        
        $reponse48= new Reponse();
        $reponse48->setTexte("Stinky liquid");
        $reponse48->setPoints(0);
        $reponse48->setQuestion($question12);

        $reponse49= new Reponse();
        $reponse49->setTexte("What I put in my salad dressing");
        $reponse49->setPoints(1);
        $reponse49->setQuestion($question12);

        $reponse50= new Reponse();
        $reponse50->setTexte("Great to remove lime spots");
        $reponse50->setPoints(2);
        $reponse50->setQuestion($question12);

        $reponse51= new Reponse();
        $reponse51->setTexte("My best friend to clean the house");
        $reponse51->setPoints(3);
        $reponse51->setQuestion($question12);
        
        $manager->persist($question12);
        $manager->persist($reponse48);
        $manager->persist($reponse49);
        $manager->persist($reponse50);
        $manager->persist($reponse51);

        $question13= new Question();
        $question13->setTexte("If I say 'bread', you think:");
        $question13->setCategorie($diy);
        
        $reponse52= new Reponse();
        $reponse52->setTexte("Supermarket");
        $reponse52->setPoints(0);
        $reponse52->setQuestion($question13);

        $reponse53= new Reponse();
        $reponse53->setTexte("Artisanal");
        $reponse53->setPoints(1);
        $reponse53->setQuestion($question13);

        $reponse54= new Reponse();
        $reponse54->setTexte("Gluten free, please");
        $reponse54->setPoints(2);
        $reponse54->setQuestion($question13);

        $reponse55= new Reponse();
        $reponse55->setTexte("Homemade");
        $reponse55->setPoints(3);
        $reponse55->setQuestion($question13);
        
        $manager->persist($question13);
        $manager->persist($reponse52);
        $manager->persist($reponse53);
        $manager->persist($reponse54);
        $manager->persist($reponse55);


        //fixture for scrolls of truth
        $scroll1 = new Scroll();
        $scroll1->setTexte("27 000 trees are cut down each day so we can have toilet paper");
        $scroll1->setCategorie($consommation);
        $manager->persist($scroll1);

        $scroll2 = new Scroll();
        $scroll2->setTexte("Aluminium can be recycled continuously, as in forever. Recycling one aluminium can saves enough energy to run our TVs for at least 3 hours.");
        $scroll2->setCategorie($consommation);
        $manager->persist($scroll2);

        $scroll3 = new Scroll();
        $scroll3->setTexte("80 trillion aluminium cans are used by human every year.");
        $scroll3->setCategorie($consommation);
        $manager->persist($scroll3);

        $scroll4 = new Scroll();
        $scroll4->setTexte("In 2019, 4.5 billion passengers were carried by the workd's airlines.");
        $scroll4->setCategorie($deplacements);
        $manager->persist($scroll4);

        $scroll5 = new Scroll();
        $scroll5->setTexte("Air pollution has effects as small as burning eyes and itchy throat to as large as breathing problems and death.");
        $scroll5->setCategorie($deplacements);
        $manager->persist($scroll5);

        $scroll6 = new Scroll();
        $scroll6->setTexte("Rising levels of air pollution in Beijing has brought a new disease: the Beijing cough.");
        $scroll6->setCategorie($deplacements);
        $manager->persist($scroll6);

        $scroll7 = new Scroll();
        $scroll7->setTexte("Making your own laundry powder only requires Marseille soap, baking soda and few drops of esssential oil.");
        $scroll7->setCategorie($diy);
        $manager->persist($scroll7);

        $scroll8 = new Scroll();
        $scroll8->setTexte("Switching to a green lifestyle does not mean you need to give up what you consider luxuries.");
        $scroll8->setCategorie($diy);
        $manager->persist($scroll8);

        for ($i = 0; $i<10; $i++){
            $user = new User();
            $user->setEmail("camcam".$i."@hotmail.com");
            $user->setPassword($this->passwordEncoder->encodePassword($user, "caputdraconis".$i));
            $user->setPseudo("camcam".$i);
            $user->setNom("Syberg");
            $user->setPrenom("Camille");
            $manager->persist($user);
        }
        $manager->flush();
    }
}
