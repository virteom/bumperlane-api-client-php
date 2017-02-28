<?php

/* index.html */
class __TwigTemplate_ed3209305c6a74d32d9a6957813b504ad1823b2cd7cab871a4018bc1b18612b9 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("_layout.html", "index.html", 1);
        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'content' => array($this, 'block_content'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "_layout.html";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 2
    public function block_title($context, array $blocks = array())
    {
        echo "{BumperLane} PHP Examples";
    }

    // line 3
    public function block_content($context, array $blocks = array())
    {
        // line 4
        echo "<ul class=\"list-group\">
    <li class=\"list-group-item\">
        <h3>Fetching Contacts</h3>
        <button class=\"btn btn-default\" type=\"button\" onclick=\"location.href = 'get-contacts.php'\">Get Contacts</button>
    </li>
    <li class=\"list-group-item\">
        <h3>Sending Email</h3>
        <form id=\"email-form\" action=\"send-email.php\">
            <div class=\"input-group\">
                <span class=\"input-group-addon\" id=\"to-label\">Send To Address</span>
                <input type=\"text\" class=\"form-control\" id=\"to\" name=\"to\" aria-describedby=\"to-label\">
                <span class=\"input-group-btn\">
                    <button class=\"btn btn-default\" type=\"button\">Send</button>
                </span>
            </div>
        </form>
    </li>
</ul>
";
    }

    public function getTemplateName()
    {
        return "index.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  38 => 4,  35 => 3,  29 => 2,  11 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "index.html", "C:\\src\\Virteom2\\Virteom.ApiClient.Php\\ClientExample\\page-templates\\index.html");
    }
}
