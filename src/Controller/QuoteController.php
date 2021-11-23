<?php

namespace App\Controller;

use App\Entity\Quote;
use App\Form\QuoteType;
use Knp\Component\Pager\PaginatorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class QuoteController extends AbstractController
{
    #[Route('/quote', name: 'quote_index')]
    public function index(Request $request, PaginatorInterface $paginator): Response
    {
        $repository = $this->getDoctrine()->getRepository(Quote::class);
        $query = $repository->createQueryBuilder('q');

        if ($request->isMethod('GET')) {
            $search = $request->query->get('recherche');
            /*$tab = array_filter($tab, function (array $quote) use ($search) {
                return (str_contains(strtoupper($quote["content"]), strtoupper($search)));
            });*/
            $query->where('q.content LIKE :search')
                  ->setParameter('search', '%'.$search.'%');
        }
        $quotes = $query->getQuery()->getResult();

        $pagination = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            4
        );

        return $this->render('quote.html.twig', [
            'quotes' => $quotes,
            'search' => $search,
            'pagination' => $pagination,
        ]);
    }

    #[Route('/quote/new', name: 'quote_new')]
    #[IsGranted('ROLE_USER')]
    public function new(Request $request): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $quote = new Quote();

        $form = $this->createForm(QuoteType::class, $quote);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($quote);
            $entityManager->flush();

            return $this->redirectToRoute('quote_index');
        }

        return $this->render('quote/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/quote/{id}/update', name: 'quote_update')]
    #[IsGranted('ROLE_USER')]
    public function update(Quote $quote, Request $request): Response
    {
        $entityManager = $this->getDoctrine()->getManager();

        $form = $this->createForm(QuoteType::class, $quote);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('quote_index');
        }

        return $this->render('quote/update.html.twig', [
            'quote' => $quote,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/quote/{id}/delete', name: 'quote_delete')]
    #[IsGranted('ROLE_USER')]
    public function delete(Quote $quote): Response
    {
        $entityManager = $this->getDoctrine()->getManager();

        $entityManager->remove($quote);
        $entityManager->flush();

        return $this->redirectToRoute('quote_index');
    }

    #[Route('/quote/random', name: 'quote_random')]
    public function random(): Response
    {
        $repository = $this->getDoctrine()->getRepository(Quote::class);
        $quotes = $repository->findAll();
        $random = random_int(1, count($quotes));
        $selectedQuote = $repository->find($random);

        return $this->render('quote/random.html.twig', [
            'quote' => $selectedQuote,
        ]);
    }
}
