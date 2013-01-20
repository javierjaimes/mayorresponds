<?php
if ($question) {
    ?>
    <div class="marco form cleanTop50">
        <h1><?php echo __('Mayor of %s please answer:', $question['City']['name']) ?></h1>
        <table cellpadding="0" cellspacing="0" class="tQuestion">
            <tr>
                <td width="100%">

                    <div class="question">
                        <?php echo $this->Html->link($question['Question']['question'], '/questions/' . $question['Question']['id']); ?>
                    </div>
                    <div class="meta">
                        <?php echo $question['City']['name']; ?> -
                        <?php echo $question['City']['country_code']; ?>
                        [<?php echo $question['Question']['created']; ?>]

                    </div>
                </td>
                <td><div class="report"><?php echo $this->Html->link(__('Report'), '/questions/report/' . $question['Question']['id']) ?></div></td>
            </tr>
            <tr>
                <td colspan="3">
                    <!-- AddThis Button BEGIN -->
                    <div class="addthis_toolbox addthis_default_style addthis_32x32_style"
                         addthis:url="http://www.mayorresponds.org/questions/<?php echo  $question['Question']['id']?>"
                         addthis:title="<?php echo __('Mayor of %s please answer:', $question['City']['name']) ?>"
                         addthis:description="<?php echo str_replace('"', "'", $question['Question']['question']) ?>">
                        <a class="addthis_button_preferred_1"></a>
                        <a class="addthis_button_preferred_2"></a>
                        <a class="addthis_button_preferred_3"></a>
                        <a class="addthis_button_preferred_4"></a>
                        <a class="addthis_button_compact"></a>
                        <a class="addthis_counter addthis_bubble_style"></a>
                    </div>
                    <script type="text/javascript">var addthis_config = {"data_track_addressbar":true};</script>
                    <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-50fb6bb5384fffe9"></script>
                    <!-- AddThis Button END -->
                </td>
            </tr>

        </table>
        <?php
        if (count($question['Answer'])) {
            ?>
            <h1><?php echo __('Answers') ?></h1>
            <?php foreach ($question['Answer'] as $answer): ?>
                <table cellpadding="0" cellspacing="0" class="tAnswer">
                    <tr>
                        <td><div class="vote"><div class="num"><?php echo $answer['vote_plus']; ?></div><div class="text"><?php echo $this->Html->link(__('Yes'), '/plus/' . $answer['id']) ?></div></div></td>
                        <td><div class="vote vote_no"><div class="num"><?php echo $answer['vote_minus']; ?></div><div class="text"><?php echo $this->Html->link(__('No'), '/minus/' . $answer['id']) ?></div></div></td>
                        <td width="100%">
                            <div class="answer">
                                <?php echo $answer['comment']; ?>
                            </div>
                            <div class="url">
                                <?php echo $this->Html->link($answer['url'], $answer['url'], array('target' => '_blank')); ?>
                            </div>
                            <div class="meta">
                                [<?php echo $answer['created']; ?>]

                            </div>
                        </td>
                        <td><div class="report"><?php echo $this->Html->link(__('Report'), '/answers/report/' . $answer['id']) ?></div></td>
                    </tr>

                </table>
            <?php endforeach; ?>
            <?php
        }
        ?>

    </div>
    <div class="questions form marco cleanTop50">
        <h1><?php echo __('I want to support this question for the mayor responds') ?></h1>
        <?php
        echo $this->Form->create('Support', array('url' => '/questions/support/' . $question['Question']['id']));

        echo $this->Form->input('confirm', array(
            'type' => 'hidden',
            'value' => '0'
        ));

        echo $this->Form->input('name', array(
            'type' => 'text',
            'label' => __('Your name:'),
            'class' => 'required',
            'maxlength' => 100,
            'div' => array('class' => 'input required')
        ));

        echo $this->Form->input('email', array(
            'type' => 'text',
            'label' => __('Your email:'),
            'class' => 'required',
            'maxlength' => 100,
            'div' => array('class' => 'input required')
        ));

        echo $this->Form->input(__('Post anwser'), array(
            'type' => 'submit',
            'label' => false,
        ));

        echo $this->Form->end();

        echo $this->Facebook->login(array('perms' => 'email,publish_stream'));
        ?>
        <?php $this->start( 'scripts_footer' ) ?>
            <script>
                FB.Event.subscribe('auth.statusChange', function(response) {
                    FB.api('/me', function(response) {
                        $( '#SupportName' ).val( response.name );
                        $( '#SupportEmail' ).val( response.email );
                        $( '#SupportConfirm' ).val( 1 );
                    });
                },true);
            </script>
        <?php $this->end( ) ?>

    </div>
    <?php
} else {
    $this->CreateQuestions->form();
}
?>
