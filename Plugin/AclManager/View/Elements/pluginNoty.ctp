<?php 
echo $this->Html->css('AclManager.animate');
echo $this->Html->css('AclManager.notyPersonalizado');
echo $this->Html->script('AclManager.noty/packaged/jquery.noty.packaged.min');
?>

<link href='http://fonts.googleapis.com/css?family=PT+Sans:regular,italic,bold,bolditalic&amp;subset=latin,latin-ext,cyrillic' rel='stylesheet' type='text/css'>



<script type="text/javascript">

        function generateNoty(type, text) {

            var n = noty({
                text        : text,
                type        : type,
                dismissQueue: true,
                layout      : 'bottomRight',
                theme       : 'relax',
                maxVisible  : 5,
                timeout: 10000,
                animation   : {
                    open  : 'animated fadeInUp',
                    close : 'animated fadeOut',
                    easing: 'swing',
                    speed : 1000
                },
            });
            //console.log('html: ' + n.options.id);
        }

    </script>