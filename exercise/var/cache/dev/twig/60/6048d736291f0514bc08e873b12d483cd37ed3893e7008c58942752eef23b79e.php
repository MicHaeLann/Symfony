<?php

/* MoaBundle:Default:index.html.twig */
class __TwigTemplate_6cc322bbee67d66c84a5859a643a8d3bf84fb02bffe5c4f768ade63dc92c729f extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_25deb1bf224a1141ebe40d2bd4f6adfbd0a7b87a3a7a03aa52f326d2626558f0 = $this->env->getExtension("native_profiler");
        $__internal_25deb1bf224a1141ebe40d2bd4f6adfbd0a7b87a3a7a03aa52f326d2626558f0->enter($__internal_25deb1bf224a1141ebe40d2bd4f6adfbd0a7b87a3a7a03aa52f326d2626558f0_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "MoaBundle:Default:index.html.twig"));

        // line 1
        echo "<html lang=\"en\">
\t<head>
\t\t<meta charset=\"utf-8\">
\t\t<meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">
\t\t<meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
\t\t<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
\t\t<meta name=\"description\" content=\"\">
\t\t<meta name=\"author\" content=\"\">
\t\t<link rel=\"icon\" href=\"../../favicon.ico\">

\t\t<title>Exercise</title>
\t</head>

\t<body>
\t\t";
        // line 15
        echo twig_escape_filter($this->env, (isset($context["format"]) ? $context["format"] : $this->getContext($context, "format")), "html", null, true);
        echo "
\t</body>
</html>
";
        
        $__internal_25deb1bf224a1141ebe40d2bd4f6adfbd0a7b87a3a7a03aa52f326d2626558f0->leave($__internal_25deb1bf224a1141ebe40d2bd4f6adfbd0a7b87a3a7a03aa52f326d2626558f0_prof);

    }

    public function getTemplateName()
    {
        return "MoaBundle:Default:index.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  38 => 15,  22 => 1,);
    }
}
/* <html lang="en">*/
/* 	<head>*/
/* 		<meta charset="utf-8">*/
/* 		<meta http-equiv="X-UA-Compatible" content="IE=edge">*/
/* 		<meta name="viewport" content="width=device-width, initial-scale=1">*/
/* 		<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->*/
/* 		<meta name="description" content="">*/
/* 		<meta name="author" content="">*/
/* 		<link rel="icon" href="../../favicon.ico">*/
/* */
/* 		<title>Exercise</title>*/
/* 	</head>*/
/* */
/* 	<body>*/
/* 		{{format}}*/
/* 	</body>*/
/* </html>*/
/* */
