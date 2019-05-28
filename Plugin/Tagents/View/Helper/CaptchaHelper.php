<?php
/**
 * Helper for Showing the use of Captcha*
 * @author     Arvind Kumar
 * @link       http://www.devarticles.in/
 * @copyright  Copyright © 2014 http://www.devarticles.in/
 * @version 2.5 - Tested OK in Cakephp 2.5.4
 */
class CaptchaHelper extends AppHelper {

/**
 * helpers
 *
 * @var array
 */

  public $helpers = array('Html', 'Form');

/**
 * Constructor
 *
 * ### Settings:
 *
 * - Get settings set from Component.
 *
 * @param View $View the view object the helper is attached to.
 * @param array $settings Settings array Settings array
 */
    public function __construct(View $View, $settings = array()) {
        parent::__construct($View, $settings);
    }

    function render($settings=array()) {

        $this->settings = array_merge($this->settings, (array)$settings);

        $this->settings['reload_txt'] = isset( $this->settings['reload_txt']) ? __($this->settings['reload_txt']) : __('Can\'t read? Reload');

        $this->settings['clabel'] = isset( $this->settings['clabel']) ? __($this->settings['clabel']) : __('<p>Enter security code shown above:</p>');

        $this->settings['mlabel'] = isset( $this->settings['mlabel']) ? __($this->settings['mlabel']) : __('Answer Simple Math');

        $controller = strtolower( $this->settings['controller']);
        $action =  $this->settings['action'];
        $qstring = array(
            'type' =>   $this->settings['type'],
            'model' =>  $this->settings['model'],
            'field' =>  $this->settings['field']
        );
        switch( $this->settings['type']):
            case 'image':
                $qstring = array_merge($qstring, array(
                    'width' =>  $this->settings['width'],
                    'height'=>  $this->settings['height'],
                    'theme' =>  $this->settings['theme'],
                    'length' => $this->settings['length'],
                ));
		?>
			<div class="col-md-6 form-group">
		<?php
                echo $this->Html->image($this->Html->url(array('controller'=>$controller, 'action'=>$action, '?'=> $qstring), true), array('vspace'=>2));?>
        <?php   echo $this->Html->link('<strong>'. $this->settings['reload_txt'].'</strong>', '#', array('class' => 'creload', 'escape' => false));
		?>
			</div>
			<div class="col-md-6 form-group">
		<?php
                echo $this->Form->input( $this->settings['model'].'.'. $this->settings['field'], array('autocomplete'=>'off','label'=> $this->settings['clabel'],'class'=>'clabel form-control'));
		?>
			</div>
		<?php
            break;
            case 'math':
                $qstring = array_merge($qstring, array('type'=>'math'));
			?>
			<div class="col-md-6 form-group">
			<?php
                if(isset($this->settings['stringOperation']))   {
                    echo  $this->settings['mlabel'] .  $this->settings['stringOperation'].' = ?';
                }   else    {
                    echo $this->requestAction(array('controller'=>$controller, 'action'=>$action, '?'=> $qstring));
                }
			?>
			</div>
			<div class="col-md-6 form-group">
			<?php
                echo $this->Form->input( $this->settings['model'].'.'. $this->settings['field'],array('autocomplete'=>'off','label'=>false,'class'=>'form-control'));
			?><small>Insert your answer in this box above</small>
			</div>
			<?php
            break;
        endswitch;
    }
}