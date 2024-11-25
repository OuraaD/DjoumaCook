<?php
namespace App\Controller\Front;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DigestiveTipsController extends AbstractController
{
    #[Route('/front/digestive', name: 'digestive_index')]
    public function index(): Response
    {
        $tips = [
            "Prenez le temps de manger lentement et mastiquez chaque bouchée. Cela permet aux enzymes salivaires de commencer la digestion dès la bouche, ce qui réduit les risques de ballonnements et facilite l'absorption des nutriments.",
            "Évitez de consommer des boissons glacées pendant les repas, car elles peuvent ralentir le processus digestif en resserrant les vaisseaux sanguins autour de l'estomac.",
            "Intégrez davantage de fibres dans votre alimentation, notamment via des fruits, légumes et céréales complètes. Cela améliore le transit intestinal tout en évitant la constipation.",
            "Évitez les repas trop copieux ou riches en graisses juste avant de vous coucher. Préférez des repas légers le soir pour éviter les reflux gastro-œsophagiens.",
            "Buvez suffisamment d’eau tout au long de la journée pour maintenir une bonne hydratation, mais évitez de boire de grandes quantités d’eau pendant les repas afin de ne pas diluer les sucs gastriques.",
            "Testez des infusions après les repas, comme celles à base de gingembre ou de menthe. Elles aident à apaiser l’estomac, à réduire les ballonnements et à favoriser une digestion harmonieuse.",
            "Incorporez des aliments fermentés, comme le yaourt, le kéfir ou la choucroute, pour renforcer votre flore intestinale et améliorer votre digestion sur le long terme.",
            "Après un repas lourd, faites une courte promenade d’environ 15 minutes. Cela stimule doucement votre digestion et aide à éviter une sensation de lourdeur.",
            "Réduisez la consommation d’aliments transformés, souvent riches en additifs et conservateurs, qui peuvent perturber le fonctionnement de l’intestin.",
            "Si vous souffrez de ballonnements fréquents, essayez de limiter les aliments riches en FODMAPs, comme certains légumes crucifères, oignons et légumineuses.",
            "Adoptez un horaire régulier pour vos repas. Manger à des heures fixes aide votre corps à anticiper et à optimiser la production des sucs digestifs.",
            "Évitez de rester assis ou couché immédiatement après avoir mangé. Attendez au moins deux heures avant de vous allonger pour éviter les remontées acides.",
            "Incluez des aliments riches en enzymes digestives naturelles, comme l’ananas ou la papaye, pour faciliter la dégradation des protéines et améliorer la digestion.",
            "Essayez de réduire votre consommation de café et d’alcool, car ces boissons peuvent irriter la muqueuse de l’estomac et ralentir la digestion.",
            "Limitez les sucreries et les produits sucrés qui fermentent facilement dans l’intestin et peuvent entraîner des ballonnements et des gaz.",
            "Faites des exercices de respiration ou de relaxation avant un repas pour réduire le stress, qui peut interférer avec le processus digestif.",
            "Privilégiez des repas équilibrés comprenant des protéines, des glucides complexes et des légumes variés pour éviter les pics de glycémie et les fringales.",
            "Si vous ressentez des crampes intestinales, les graines de fenouil ou une tisane à base de camomille peuvent apporter un soulagement naturel.",
            "Réduisez les portions si vous avez tendance à trop manger. Privilégiez plusieurs petits repas dans la journée plutôt qu’un ou deux très copieux.",
            "Testez le vinaigre de cidre dilué dans de l’eau avant les repas pour stimuler les sucs digestifs. Cela peut améliorer la digestion des graisses et des protéines."
        ];

        return $this->render('front/digestive/index.html.twig', [
            'tips' => $tips,
        ]);
    }
}
