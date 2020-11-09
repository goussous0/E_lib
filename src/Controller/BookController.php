<?php

namespace App\Controller;

use App\Entity\Book;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\RangeType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
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
    public function createBook(Request $request)
    {
        // you can fetch the EntityManager via $this->getDoctrine()
        // or you can add an argument to the action: createProduct(EntityManagerInterface $entityManager)
        //$entityManager = $this->getDoctrine()->getManager();

        $book = new Book();
        $form = $this->createFormBuilder($book)
            ->add('name', TextType::class)
            ->add('year', IntegerType::class)
            ->add('author', TextType::class)

            ->getForm();

        $request->server->get('HTTP_HOST');

        //echo "$request  ";

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $task = $form->getData();

            // ... perform some action, such as saving the task to the database
            // for example, if Task is a Doctrine entity, save it!
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($form->getData());
            $entityManager->flush();

            return $this->redirectToRoute('add_book');
        }

        return $this->render('book/add_book.html.twig', [
                'form' => $form->createView(),
            ]);
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
        $form = $this->createFormBuilder()
            ->add('name', RangeType::class)
            ->add('year', RangeType::class)
            ->add('author', RangeType::class)

            ->getForm();

        $all_books = $this->getDoctrine()
            ->getRepository(Book::class)
            ->findAll();

        if (!$all_books) {
            throw $this->createNotFoundException('database is empty or there was an error connecting to db');
        }

        return $this->render('book/list.html.twig', [
            'pageData' => $all_books,
            ]);
    }

    /**
     * @Route("/book_number", name="book_number")
     */
    public function edit_book(Request $request)
    {
        //$book = new Book();

        $form = $this->createFormBuilder()
            ->add('id', IntegerType::class)
            ->add('name', TextType::class)
            ->getForm();

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated

            $Data_ = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $book = $entityManager->getRepository(Book::class)->find($Data_['id']);

            if (!$book) {
                throw $this->createNotFoundException('No book found for id '.$Data_['id']);
            }

            $book->setName($Data_['name']);
            $entityManager->flush();

            return $this->redirectToRoute('book');
        }

        return $this->render('book/edit_book.html.twig', [
            'form' => $form->createView(),
            ]);
    }
}
