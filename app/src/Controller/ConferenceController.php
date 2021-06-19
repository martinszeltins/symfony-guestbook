<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\Conference;
use App\Repository\CommentRepository;
use App\Repository\ConferenceRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ConferenceController extends AbstractController
{
    public function __construct(private CommentRepository $commentRepository) {}

    #[Route('/', name: 'homepage')]
    public function index(ConferenceRepository $conferenceRepository): Response
    {
        return $this->render('conference/index.html.twig');
    }

    #[Route('/conference/{id}', name: 'conference')]
    public function show(Request $request, Conference $conference): Response
    {
        $offset = max(0, $request->query->getInt('offset', 0));
        $paginator = $this->commentRepository->getCommentPaginator($conference, $offset);

        return $this->render('conference/show.html.twig', [
            'conference'    => $conference,
            'comments'      => $paginator,
            'next'          => min(count($paginator), $offset + CommentRepository::PAGINATOR_PER_PAGE),
            'previous'      => $offset - CommentRepository::PAGINATOR_PER_PAGE,
        ]);
    }
}
