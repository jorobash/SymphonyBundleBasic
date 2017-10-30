<?php


namespace JoroBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use JoroBundle\Entity\user1;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="joro")
     */
    public function homeAction(Request $request)
    {
        $user = $this->getDoctrine()
        ->getRepository('JoroBundle:user1')
        ->findAll();

        return $this->render('JoroBundle:Default:index.html.twig');
    }

     /**
     * @Route("/kiro", name="test")
     */
    public function aboutAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('JoroBundle:test:test.html.twig');
    }

     /**
     * @Route("/reg", name="reg")
     */
    public function registerAction(Request $request)
    {
        $user = new user1();
        // $user->setUserName('joro567');
        // $user->setFirstName('fn');
        // $user->setLastName('ln');
        // $user->setPassword('12345');
        // $user->setRegDate(new \DateTime('today'));

        $form = $this->createFormBuilder($user)
        
        ->add('userName',TextType::class)
        ->add('firstName',TextType::class)
        ->add('lastName',TextType::class)
        ->add('password',TextType::class)
        ->add('email',TextType::class)
        ->add('regDate',DateType::class)
        ->add('Register',submitType::class,array('label'=> 'reg'))
        ->getForm();

        $form->handleRequest($request);


        if($form->isSubmitted() && $form->isValid()){
          
            $un = $form['userName']->getData();
            $fN = $form['firstName']->getData();
            $lN = $form['lastName']->getData();
            $ps = $form['password']->getData();
            $email = $form['email']->getData();
            $date = $form['regDate']->getData();

          
            $user->setUserName($un);
            $user->setFirstName($fN);
            $user->setLastName($lN);
            $user->setPassword($ps);
            $user->setEmail($email);
            $user->setRegDate($date);

            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            

            // $this->addFlash('Success',"user register");
            // return $this->redirectToRoute('reg');
            $em->flush();
          
        }

        return $this->render('JoroBundle:Default:register.html.twig',array(
            'form' =>$form->createView(),
            ));
    }

    /**
     * @Route("/lucky", name="lucky")
     */
    public function luckyAction(Request $request)
    {
       $number = rand(0, 100);
        return $this->render('JoroBundle:Default:register.html.twig', array('number' => $number ));
    }
}