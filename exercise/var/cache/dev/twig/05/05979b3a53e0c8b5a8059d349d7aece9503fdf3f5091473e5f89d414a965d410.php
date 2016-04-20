<?php

/* base.html.twig */
class __TwigTemplate_531f778712a429d32fdb0e2266ffee5a6148ff118a3e4cc0aa2831c701ab0f35 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'stylesheets' => array($this, 'block_stylesheets'),
            'body' => array($this, 'block_body'),
            'javascripts' => array($this, 'block_javascripts'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_5f0106279c4811e5eb5428b6b7601a050514dfda610d5abd8d906bbe01628234 = $this->env->getExtension("native_profiler");
        $__internal_5f0106279c4811e5eb5428b6b7601a050514dfda610d5abd8d906bbe01628234->enter($__internal_5f0106279c4811e5eb5428b6b7601a050514dfda610d5abd8d906bbe01628234_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "base.html.twig"));

        // line 1
        echo "<!DOCTYPE html>
<html>
    <head>
        <meta charset=\"UTF-8\" />
        <title>";
        // line 5
        $this->displayBlock('title', $context, $blocks);
        echo "</title>
        ";
        // line 6
        $this->displayBlock('stylesheets', $context, $blocks);
        // line 7
        echo "        <link rel=\"icon\" type=\"image/x-icon\" href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('asset')->getAssetUrl("favicon.ico"), "html", null, true);
        echo "\" />
    </head>
    <body>
        ";
        // line 10
        $this->displayBlock('body', $context, $blocks);
        // line 11
        echo "        ";
        $this->displayBlock('javascripts', $context, $blocks);
        // line 12
        echo "    </body>
</html>
";
        
        $__internal_5f0106279c4811e5eb5428b6b7601a050514dfda610d5abd8d906bbe01628234->leave($__internal_5f0106279c4811e5eb5428b6b7601a050514dfda610d5abd8d906bbe01628234_prof);

    }

    // line 5
    public function block_title($context, array $blocks = array())
    {
        $__internal_b897cb8956c23de4edc4f59b845bfb0a8e16a955173d3cf5838dab5daaa8c139 = $this->env->getExtension("native_profiler");
        $__internal_b897cb8956c23de4edc4f59b845bfb0a8e16a955173d3cf5838dab5daaa8c139->enter($__internal_b897cb8956c23de4edc4f59b845bfb0a8e16a955173d3cf5838dab5daaa8c139_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "title"));

        echo "Welcome!";
        
        $__internal_b897cb8956c23de4edc4f59b845bfb0a8e16a955173d3cf5838dab5daaa8c139->leave($__internal_b897cb8956c23de4edc4f59b845bfb0a8e16a955173d3cf5838dab5daaa8c139_prof);

    }

    // line 6
    public function block_stylesheets($context, array $blocks = array())
    {
        $__internal_48d728eab888ef313606da14865b9d67b9496f8a5ffdfa9559b4823673b97b79 = $this->env->getExtension("native_profiler");
        $__internal_48d728eab888ef313606da14865b9d67b9496f8a5ffdfa9559b4823673b97b79->enter($__internal_48d728eab888ef313606da14865b9d67b9496f8a5ffdfa9559b4823673b97b79_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "stylesheets"));

        
        $__internal_48d728eab888ef313606da14865b9d67b9496f8a5ffdfa9559b4823673b97b79->leave($__internal_48d728eab888ef313606da14865b9d67b9496f8a5ffdfa9559b4823673b97b79_prof);

    }

    // line 10
    public function block_body($context, array $blocks = array())
    {
        $__internal_eef380fa01372ba56926eb1c6fca30959ccb2188502eca5e336f06439f3beb22 = $this->env->getExtension("native_profiler");
        $__internal_eef380fa01372ba56926eb1c6fca30959ccb2188502eca5e336f06439f3beb22->enter($__internal_eef380fa01372ba56926eb1c6fca30959ccb2188502eca5e336f06439f3beb22_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "body"));

        
        $__internal_eef380fa01372ba56926eb1c6fca30959ccb2188502eca5e336f06439f3beb22->leave($__internal_eef380fa01372ba56926eb1c6fca30959ccb2188502eca5e336f06439f3beb22_prof);

    }

    // line 11
    public function block_javascripts($context, array $blocks = array())
    {
        $__internal_d94116b7e717ed4fc4a9cb96ab58065662ca5685187ca236b09059a8ac165bfe = $this->env->getExtension("native_profiler");
        $__internal_d94116b7e717ed4fc4a9cb96ab58065662ca5685187ca236b09059a8ac165bfe->enter($__internal_d94116b7e717ed4fc4a9cb96ab58065662ca5685187ca236b09059a8ac165bfe_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "javascripts"));

        
        $__internal_d94116b7e717ed4fc4a9cb96ab58065662ca5685187ca236b09059a8ac165bfe->leave($__internal_d94116b7e717ed4fc4a9cb96ab58065662ca5685187ca236b09059a8ac165bfe_prof);

    }

    public function getTemplateName()
    {
        return "base.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  93 => 11,  82 => 10,  71 => 6,  59 => 5,  50 => 12,  47 => 11,  45 => 10,  38 => 7,  36 => 6,  32 => 5,  26 => 1,);
    }
}
/* <!DOCTYPE html>*/
/* <html>*/
/*     <head>*/
/*         <meta charset="UTF-8" />*/
/*         <title>{% block title %}Welcome!{% endblock %}</title>*/
/*         {% block stylesheets %}{% endblock %}*/
/*         <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}" />*/
/*     </head>*/
/*     <body>*/
/*         {% block body %}{% endblock %}*/
/*         {% block javascripts %}{% endblock %}*/
/*     </body>*/
/* </html>*/
/* */
