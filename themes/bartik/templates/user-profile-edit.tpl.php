<html>
<div id="user-edit-<?php print $user->uid; ?>" class="user-edit-form">
    <div class="user-edit-container" id="user-edit-container">
        <?php print render($form['form_id']); ?>
        <?php print render($form['form_build_id']); ?>
        <?php print render($form['form_token']); ?>
        <input type="input" id="ViewMode" class="currentedittab" name="ViewMode" value="" style="display: none;">

        <div class="useredittabcontainer" id="useredittabcontainer">
            <ul class="usereditlist">
                <li id="accountinfo" class="useredittab accountinfo" onclick="clicktab('accountinfo');">Account Information</li>
                <li id="changeprofile" class="useredittab changeprofile" onclick="clicktab('changeprofile');">Profile Information</li>
                <li id="changeadditionalprofile" class="useredittab changeadditionalprofile" onclick="clicktab('changeadditionalprofile');">Additional Profile Information</li>
                <li id="changepassword" class="useredittab changepassword" onclick="clicktab('changepassword');">Change Password</li>
                <li id="showalledit" class="useredittab showalledit" onclick="clicktab('showalledit');">Show All</li>
            </ul>
        </div>

        <div class="usereditborder" id="usereditborder">
            <div class="showalledit toggleelement"><h3>Account Information</h3></div>
            <div class="showalledit accountinfo toggleelement"><?php print render($form['account']['name']); ?></div>
            <div class="showalledit accountinfo toggleelement"><?php print render($form['field_first_name']); ?></div>
            <div class="showalledit accountinfo toggleelement"><?php print render($form['field_middle_name']); ?></div>
            <div class="showalledit accountinfo toggleelement"><?php print render($form['field_last_name']); ?></div>
            <div class="showalledit accountinfo toggleelement"><?php print render($form['account']['mail']); ?></div>
            <div class="showalledit toggleelement"><hr></div>
            <div class="showalledit toggleelement"><h3>Change Password</h3></div>
            <div id="currpass" class="showalledit accountinfo changepassword toggleelement"><?php print render($form['account']['current_pass']); ?></div>
            <div class="showalledit changepassword toggleelement"><?php print render($form['account']['pass']); ?></div>
            <div class="showalledit toggleelement"><hr></div>
            <div class="showalledit toggleelement"><h3>Profile Information</h3></div>
            <div class="showalledit changeprofile toggleelement"><?php print render($form['field_address']); ?></div>
            <div class="showalledit changeprofile toggleelement"><?php print render($form['field_city']); ?></div>
            <div class="showalledit changeprofile toggleelement"><?php print render($form['field_state']); ?></div>
            <div class="showalledit changeprofile toggleelement"><?php print render($form['field_zip_code']); ?></div>
            <div class="showalledit changeprofile toggleelement"><?php print render($form['field_phone_number']); ?></div>
            <div class="showalledit changeprofile toggleelement"><?php print render($form['field_date_of_birth']); ?></div>
            <div class="showalledit changeprofile toggleelement"><?php print render($form['field_gender']); ?></div>
            <div class="showalledit toggleelement"><hr></div>
            <div class="showalledit toggleelement"><h3>Additional Profile Information</h3></div>
            <div class="showalledit changeadditionalprofile toggleelement"><?php print render($form['timezone']['timezone']); ?><hr></div>
            <div class="showalledit changeadditionalprofile toggleelement"><?php print render($form['signature_settings']['signature']); ?><hr></div>
            <div class="showalledit changeadditionalprofile toggleelement" style="min-height:135px;">
                <div class="showalledit changeadditionalprofile toggleelement"><?php print render($form['picture']['picture_current']); ?></div>
                <div class="showalledit changeadditionalprofile toggleelement"><?php print render($form['picture']['picture_upload']); ?></div>
                <div class="showalledit changeadditionalprofile toggleelement"><?php print render($form['picture']['picture_delete']); ?></div>
            </div>
            <div class="showalledit changeadditionalprofile toggleelement"><?php print render($form['account']['status']); ?></div>
            <div class="showalledit changeadditionalprofile toggleelement"><?php print render($form['account']['roles']); ?></div>
            <div class="showalledit changeadditionalprofile toggleelement"><?php print render($form['account']['notify']); ?></div>
            <div class="showalledit accountinfo toggleelement"><?php print render($form['field_terms_of_use']); ?></div>
        </div>

        <?php print render($form['actions']); ?>
    </div><!--end user-edit container-->

    <script type="text/javascript">
        afterpageload();
        function afterpageload() {
            var themode=getmode();
            <?php
            print('var prevMode =  \'');
            print($_REQUEST['ViewMode']);
            print('\';');
            ?>

            switch (themode) {
                case "chpwd":
                    prevMode = '';
                    break;
                case "chpwdonly":
                    prevMode = '';
                    break;
            }


            switch (themode) {
                case "chpwd":
                    break;
                case "chpwdonly":
                    break;
                default:
                    if (prevMode.length > 0) {
                        themode = prevMode;
                    }
                    break;
            }


            switch (themode) {
                case "chpwd":
                    //select the Change Password tab
                    clicktab("changepassword");
                    //Hide the selector tabs to clean up the interface
                    document.getElementById("useredittabcontainer").style.display = 'none';
                    break;
                case "chpwdonly":
                    //select the Change Password tab
                    clicktab("changepassword");
                    //This is used for password reset, so hide the Current Password field.
                    document.getElementById("currpass").style.display='none';
                    //Hide the selector tabs to clean up the interface
                    document.getElementById("useredittabcontainer").style.display = 'none';
                    break;
                case "showchpwd":
                    //Select the Change Password tab.
                    clicktab("changepassword");
                    break;
                case "showprofile":
                    //Select the Profile tab
                    clicktab("changeprofile");
                    break;
                case "showaddlprofile":
                    //Select the Additional Profile Information tab
                    clicktab("changeadditionalprofile");
                    break;
                case "showall":
                    //Select the Show All tab
                    clicktab("showalledit");
                    break;
                case "showaccount":
                default:
                    //Select the Account Information tab. This is the default behavior.
                    clicktab("accountinfo");
                    break;
            }
        }

        function getmode() {
            //Get the ?viewmode= argument, if any.
            <?php
            print('var returnmode = \'');
            print($_GET["viewmode"]);
            print('\';');
            ?>

            if (returnmode.length==0) {
                //If there is no ?viewmode= argument, check to see
                //if this is a password reset
                returnmode = ispasswordreset()
            }

            return returnmode;
        }

        function ispasswordreset() {
            //Get the ?pass-reset-token= argument, if any.
            <?php
            print('var passreset = \'');
            print($_GET["pass-reset-token"]);
            print('\';');
            ?>

            if (passreset.length==0) {
                //This is not a password reset, so start up in the default (normal) tab
                return "normal";
            }
            else
            {
                //This is a password reset. Start up with the password fields only.
                return "chpwdonly";
            }
        }

        function clicktab(showclass) {
            //Get all of the elements that have the 'toggleelement' class.
            var items = document.getElementsByClassName('toggleelement');

            //Loop through each element, looking for the 'donothide' class.
            //This will allow some elements to be displayed in all modes.
            for (var iCtr = 0; iCtr < items.length; iCtr++){
                if (!hasClass(items[iCtr], "donothide")) {
                    //This does not have the 'donothide' class. Keep processing.
                    if (hasClass(items[iCtr], showclass)) {
                        //This is marked with the selected class (variable showclass).
                        //Make sure it is visible.
                        items[iCtr].style.display = '';
                    }
                    else
                    {
                        //This is not marked with the selected class. Hide it.
                        items[iCtr].style.display = 'none';
                    }
                }
            }
            //Now that the elements are shown or hidden,
            //Indicate the current tab.
            settabproperties(showclass);
            setParameter(showclass);
        }

        function settabproperties(activetab) {
            //Get all of the elements in the user edit menu/tab list.
            var tabs = document.getElementsByClassName('useredittab');

            //Loop through, looking for the active tab, indicated by the variable activetab.
            for (var iCtr = 0; iCtr < tabs.length; iCtr++) {
                if (hasClass(tabs[iCtr], activetab)) {
                    //This is the active tab.
                    tabs[iCtr].style.backgroundColor='red';
                    tabs[iCtr].style.color='white';
                    tabs[iCtr].style.borderColor='red';
                }
                else
                {
                    //This is an inactive tab.
                    tabs[iCtr].style.backgroundColor='#eeeeee';
                    tabs[iCtr].style.color='black';
                    tabs[iCtr].style.borderColor='#bbbbbb';
                }
            }
        }

        function hasClass(element, cls) {
            //Pad the className with spaces, and search for the class (cls).
            //cls is also padded to ensure that any results found are not substrings
            //of other classes.
            return (' ' + element.className + ' ').search(' ' + cls + ' ') > -1;
        }

        function setParameter(currTab) {
            var newViewmode = '';
            switch (currTab) {
                case "accountinfo":
                    newViewmode = 'showaccount';
                    break;
                case "changeprofile":
                    newViewmode = 'showprofile';
                    break;
                case "changeadditionalprofile":
                    newViewmode = 'showaddlprofile';
                    break;
                case "changepassword":
                    newViewmode = 'showchpwd';
                    break;
                case "showalledit":
                    newViewmode = 'showall';
                    break;
                default:
                    newViewmode = "default";
                    break;
            }
            document.getElementById('ViewMode').value=newViewmode;
        }
    </script>
</div><!--end user-edit-->
</html>