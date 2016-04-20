<?php

/* @Twig/Exception/exception_full.html.twig */
class __TwigTemplate_cfa0a8f5ec31a8437d70538b67bf15bd1cb1cdccc9b6d15480b3913e696967bd extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("@Twig/layout.html.twig", "@Twig/Exception/exception_full.html.twig", 1);
        $this->blocks = array(
            'head' => array($this, 'block_head'),
            'title' => array($this, 'block_title'),
            'body' => array($this, 'block_body'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "@Twig/layout.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_4d3ad72569f6794424ae9a6334499b94635c4377e8bef21c07ac8c8efcf934ca = $this->env->getExtension("native_profiler");
        $__internal_4d3ad72569f6794424ae9a6334499b94635c4377e8bef21c07ac8c8efcf934ca->enter($__internal_4d3ad72569f6794424ae9a6334499b94635c4377e8bef21c07ac8c8efcf934ca_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "@Twig/Exception/exception_full.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_4d3ad72569f6794424ae9a6334499b94635c4377e8bef21c07ac8c8efcf934ca->leave($__internal_4d3ad72569f6794424ae9a6334499b94635c4377e8bef21c07ac8c8efcf934ca_prof);

    }

    // line 3
    public function block_head($context, array $blocks = array())
    {
        $__internal_d53f094200bd3133a854e5a987444328baf269d2ccd0894f397500226df19929 = $this->env->getExtension("native_profiler");
        $__internal_d53f094200bd3133a854e5a987444328baf269d2ccd0894f397500226df19929->enter($__internal_d53f094200bd3133a854e5a987444328baf269d2ccd0894f397500226df19929_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "head"));

        // line 4
        echo "    <link href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('request')->generateAbsoluteUrl($this->env->getExtension('asset')->getAssetUrl("bundles/framework/css/exception.css")), "html", null, true);
        echo "\" rel=\"stylesheet\" type=\"text/css\" media=\"all\" />
";
        
        $__internal_d53f094200bd3133a854e5a987444328baf269d2ccd0894f397500226df19929->leave($__internal_d53f094200bd3133a854e5a987444328baf269d2ccd0894f397500226df19929_prof);

    }

    // line 7
    public function block_title($context, array $blocks = array())
    {
        $__internal_91bd5ff258c71c49bd3bf5b028d1cf5eeae29562649b899e1ffb7a4163b6b26a = $this->env->getExtension("native_profiler");
        $__internal_91bd5ff258c71c49bd3bf5b028d1cf5eeae29562649b899e1ffb7a4163b6b26a->enter($__internal_91bd5ff258c71c49bd3bf5b028d1cf5eeae29562649b899e1ffb7a4163b6b26a_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "title"));

        // line 8
        echo "    ";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["exception"]) ? $context["exception"] : $this->getContext($context, "exception")), "message", array()), "html", null, true);
        echo " (";
        echo twig_escape_filter($this->env, (isset($context["status_code"]) ? $context["status_code"] : $this->getContext($context, "status_code")), "html", null, true);
        echo " ";
        echo twig_escape_filter($this->env, (isset($context["status_text"]) ? $context["status_text"] : $this->getContext($context, "status_text")), "html", null, true);
        echo ")
";
        
        $__internal_91bd5ff258c71c49bd3bf5b028d1cf5eeae29562649b899e1ffb7a4163b6b26a->leave($__internal_91bd5ff258c71c49bd3bf5b028d1cf5eeae29562649b899e1ffb7a4163b6b26a_prof);

    }

    // line 11
    public function block_body($context, array $blocks = array())
    {
        $__internal_b987e3fafb1f126189ee608fbfa543b63fd981fd031bfb5669c683f1772913bc = $this->env->getExtension("native_profiler");
        $__internal_b987e3fafb1f126189ee608fbfa543b63fd981fd031bfb5669c683f1772913bc->enter($__internal_b987e3fafb1f126189ee608fbfa543b63fd981fd031bfb5669c683f1772913bc_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "body"));

        // line 12
        echo "    ";
        $this->loadTemplate("@Twig/Exception/exception.html.twig", "@Twig/Exception/exception_full.html.twig", 12)->display($context);
        
        $__internal_b987e3fafb1f126189ee608fbfa543b63fd981fd031bfb5669c683f1772913bc->leave($__internal_b987e3fafb1f126189ee608fbfa543b63fd981fd031bfb5669c683f1772913bc_prof);

    }

    public function getTemplateName()
    {
        return "@Twig/Exception/exception_full.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  78 => 12,  72 => 11,  58 => 8,  52 => 7,  42 => 4,  36 => 3,  11 => 1,);
    }
}
/* {% extends '@Twig/layout.html.twig' %}*/
/* */
/* {% block head %}*/
/*     <link href="{{ absolute_url(asset('bundles/framework/css/exception.css')) }}" rel="stylesheet" type="text/css" media="all" />*/
/* {% endblock %}*/
/* */
/* {% block title %}*/
/*     {{ exception.message }} ({{ status_code }} {{ status_text }})*/
/* {% endblock %}*/
/* */
/* {% block body %}*/
/*     {% include '@Twig/Exception/exception.html.twig' %}*/
/* {% endblock %}*/
/* */
