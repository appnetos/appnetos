{* Demo forgotten password :: Smarty template *}
<h4>
    {$strings->get("html_string__demo_forgotten_password__string_one")}
</h4>
<h5>
    {$strings->get("html_string__demo_forgotten_password__string_two")}
</h5>
{$render->include('application/apps/html_string/demo_forgotten_password/application/views/demo_forgotten_password__twig.twig')}