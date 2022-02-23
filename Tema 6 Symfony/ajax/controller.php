
    /**
     * @Route("/ruta", name="miruta", methods={"GET"})
     * @IsGranted("ROLE_USER")
     */
    public function getDato(Request $request)
    { 
        $instancia = $this->getDoctrine()->getRepository(Clase::class)->find($request->query->get('idGame'));
      
        if ( !$instancia)
            return new Response("Error");

        //modificamos los datos que queramos de la instancia y la guardamos
        $instancia->setState(true);

        $em = $this->getDoctrine()->getManager();
        $em->persist($instancia);
        $em->flush();

              
        return new Response($instancia->getAttr());

    }