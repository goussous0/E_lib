<?php

namespace App\Controller;

use App\Entity\Book;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BookController extends AbstractController
{
    /**
     * @Route("/book", name="book")
     */
    public function index(): Response
    {
        return $this->render('book/index.html.twig', [
            'controller_name' => 'BookController',
        ]);
    }

    /**
     * @Route("/add_book" , name="add_book")
     */
    public function createBook(): Response
    {
        // you can fetch the EntityManager via $this->getDoctrine()
        // or you can add an argument to the action: createProduct(EntityManagerInterface $entityManager)
        $entityManager = $this->getDoctrine()->getManager();

        // figure out how to pass arguments to the vars below
        $book = new Book();
        $book->setName('Macbeth');
        $book->setYear(1999);
        $book->setAuthor('shakespear');

        // tell Doctrine you want to (eventually) save the Product (no queries yet)
        $entityManager->persist($book);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();

        return new Response('Saved new product with id '.$book->getId());
    }

    /**
     * @Route("/book/{id}", name="book_show")
     */
    public function show($id)
    {
        $book = $this->getDoctrine()
            ->getRepository(Book::class)
            ->find($id);

        if (!$book) {
            throw $this->createNotFoundException('No book found for id '.$id);
        }

        return new Response('is this your book : '.$book->getName());
    }

    /**
     * @Route("/list", name="list_books")
     */
    public function list()
    {
        $all_books = $this->getDoctrine()
            ->getRepository(Book::class)
            ->findAll();

        if (!$all_books) {
            throw $this->createNotFoundException('database is empty or there was an error connecting to db');
        }

        for ($x = 0; $x < count($all_books); ++$x) {
            $tmp = $all_books[$x]->getName();

            echo "$tmp ,";
        }
        echo "\n";

        return new Response(' All books in the db  ');
    }
}
