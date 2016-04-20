<?php

/* @WebProfiler/Collector/router.html.twig */
class __TwigTemplate_3c5c07469cc128a4048dbd40002bbdbc27a7ddb79bc6a303e0694246f339bd8a extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("@WebProfiler/Profiler/layout.html.twig", "@WebProfiler/Collector/router.html.twig", 1);
        $this->blocks = array(
            'toolbar' => array($this, 'block_toolbar'),
            'menu' => array($this, 'block_menu'),
            'panel' => array($this, 'block_panel'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "@WebProfiler/Profiler/layout.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_9be93b5fffe3c2100ca8377073b93842ebdd88e51b668e161a81ebda2c3453fb = $this->env->getExtension("native_profiler");
        $__internal_9be93b5fffe3c2100ca8377073b93842ebdd88e51b668e161a81ebda2c3453fb->enter($__internal_9be93b5fffe3c2100ca8377073b93842ebdd88e51b668e161a81ebda2c3453fb_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "@WebProfiler/Collector/router.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_9be93b5fffe3c2100ca8377073b93842ebdd88e51b668e161a81ebda2c3453fb->leave($__internal_9be93b5fffe3c2100ca8377073b93842ebdd88e51b668e161a81ebda2c3453fb_prof);

    }

    // line 3
    public function block_toolbar($context, array $blocks = array())
    {
        $__internal_79d24ce87203818b4d6f5c37e322caa06d7cfc17c40f533cd6af7cb247bef6c2 = $this->env->getExtension("native_profiler");
        $__internal_79d24ce87203818b4d6f5c37e322caa06d7cfc17c40f533cd6af7cb247bef6c2->enter($__internal_79d24ce87203818b4d6f5c37e322caa06d7cfc17c40f533cd6af7cb247bef6c2_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "toolbar"));

        
        $__internal_79d24ce87203818b4d6f5c37e322caa06d7cfc17c40f533cd6af7cb247bef6c2->leave($__internal_79d24ce87203818b4d6f5c37e322caa06d7cfc17c40f533cd6af7cb247bef6c2_prof);

    }

    // line 5
    public function block_menu($context, array $blocks = array())
    {
        $__internal_0045238244dfb7163c101ded0c9a64f593209483b070b297e9fe41c6b5193410 = $this->env->getExtension("native_profiler");
        $__internal_0045238244dfb7163c101ded0c9a64f593209483b070b297e9fe41c6b5193410->enter($__internal_0045238244dfb7163c101ded0c9a64f593209483b070b297e9fe41c6b5193410_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "menu"));

        // line 6
        echo "<span class=\"label\">
    <span class=\"icon\">";
        // line 7
        echo twig_include($this->env, $context, "@WebProfiler/Icon/router.svg");
        echo "</span>
    <strong>Routing</strong>
</span>
";
        
        $__internal_0045238244dfb7163c101ded0c9a64f593209483b070b297e9fe41c6b5193410->leave($__internal_0045238244dfb7163c101ded0c9a64f593209483b070b297e9fe41c6b5193410_prof);

    }

    // line 12
    public function block_panel($context, array $blocks = array())
    {
        $__internal_b25998108a2ab85a6b6359d14b67d07904be8e0a764fc211fb6dc5d8c4d89a9b = $this->env->getExtension("native_profiler");
        $__internal_b25998108a2ab85a6b6359d14b67d07904be8e0a764fc211fb6dc5d8c4d89a9b->enter($__internal_b25998108a2ab85a6b6359d14b67d07904be8e0a764fc211fb6dc5d8c4d89a9b_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "panel"));

        // line 13
        echo "    ";
        echo $this->env->getExtension('http_kernel')->renderFragment($this->env->getExtension('routing')->getPath("_profiler_router", array("token" => (isset($context["token"]) ? $context["token"] : $this->getContext($context, "token")))));
        echo "
";
        
        $__internal_b25998108a2ab85a6b6359d14b67d07904be8e0a764fc211fb6dc5d8c4d89a9b->leave($__internal_b25998108a2ab85a6b6359d14b67d07904be8e0a764fc211fb6dc5d8c4d89a9b_prof);

    }

    public function getTemplateName()
    {
        return "@WebProfiler/Collector/router.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  73 => 13,  67 => 12,  56 => 7,  53 => 6,  47 => 5,  36 => 3,  11 => 1,);
    }
}
/* {% extends '@WebProfiler/Profiler/layout.html.twig' %}*/
/* */
/* {% block toolbar %}{% endblock %}*/
/* */
/* {% block menu %}*/
/* <span class="label">*/
/*     <span class="icon">{{ include('@WebProfiler/Icon/router.svg') }}</span>*/
/*     <strong>Routing</strong>*/
/* </span>*/
/* {% endblock %}*/
/* */
/* {% block panel %}*/
/*     {{ render(path('_profiler_router', { token: token })) }}*/
/* {% endblock %}*/
/* */
