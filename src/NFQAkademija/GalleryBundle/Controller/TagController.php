<?php

namespace NFQAkademija\GalleryBundle\Controller;

use NFQAkademija\GalleryBundle\Entity\Tag;
use NFQAkademija\GalleryBundle\Form\TagType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class TagController extends Controller
{
    /**
     * Searches for photos by tag name
     * and renders photos by tag.
     *
     * @param $name
     * @return Response
     */
    public function indexAction($name)
    {
        $em = $this->getDoctrine()->getManager();

        $tags = $em->getRepository('NFQAkademijaGalleryBundle:Tag')
                ->findBy(array('name' => $name), array('id' => 'DESC'));

        return $this->render(
            'NFQAkademijaGalleryBundle:Tag:index.html.twig',
            array(
                'tags' => $tags
            )
        );
    }

    /**
     * Creates search form and renders it.
     *
     * @return Response
     */
    public function formAction()
    {
        $form = $this->createForm(
            new TagType(true),
            new Tag(),
            array(
                'action' => $this->generateUrl('nfqakademija_search_post'),
            )
        );

        return $this->render(
            'NFQAkademijaGalleryBundle:Tag:form.html.twig',
            array(
                'search_form' => $form->createView()
            )
        );
    }

    /**
     * Handles search request from form and
     * redirects to index.
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function postAction(Request $request)
    {
        $form = $this->createForm(new TagType(true), new Tag());
        $form->handleRequest($request);
        $tag = $form->getData();
        $name = $tag->getName();
        return $this->redirect($this->generateUrl('nfqakademija_search_results', array('name' => $name)));
    }

}