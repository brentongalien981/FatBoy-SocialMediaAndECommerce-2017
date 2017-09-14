<div id="chat-pod" class="">
    <div id="chat-wall">
    </div>

    <textarea id="chat-textarea" placeholder="say it to 'em"></textarea>

    <div id="keyboard-area">
        <div id="keyboard-container">

            <div id="smileys-keyboard" class="emoji-keyboard">

                <?php for ($i = 128512, $j = 0; $i <= 128582; $i++, $j++) { ?>
                    <button class="keyboard-keys"><?="&#{$i}"?></button>
                <?php } ?>
            </div>

            <div class="emoji-keyboard">
            </div>

        </div>
    </div>



    <div id="chat-pod-buttons-bar">
        <nav id="chat-pod-buttons-nav">
            <button class="chat-pod-bar-buttons"><i class="fa fa-paper-plane chat-pod-bar-button-icon"></i></button>
            <button class="chat-pod-bar-buttons"><i class="fa fa-meh-o chat-pod-bar-button-icon"></i></button>
        </nav>
    </div>
</div>