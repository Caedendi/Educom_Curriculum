package nu.educom.bartcommandeur._5b2.presenters;

import nu.educom.bartcommandeur._5b2.models.ILoginValidation;
import nu.educom.bartcommandeur._5b2.models.MISixModel;
import nu.educom.bartcommandeur._5b2.views.IMISixInput;

public class MISixPresenter implements ILoginReceivedListener {
    private ILoginValidation model;
    private IMISixInput view;

    public MISixPresenter(IMISixInput view) {
        this.view = view;
        model = new MISixModel();
        view.addILoginReceivedListener(this);
    }

    public void run() {
        view.setDisplayState(IMISixInput.DisplayState.BOOT);
        //view.setDisplayState(IMISixInput.DisplayState.ASK_ID); // JH: Added for event driven

        /* JH: Remove code belowe for Event driven */
        while( true ) {
            view.setDisplayState(IMISixInput.DisplayState.ASK_ID);
            if( model.getIdValid() ) {
                view.setDisplayState(IMISixInput.DisplayState.ASK_PASSWORD);
            }
            if( model.isLoggedIn() ) {
                view.setDisplayState(IMISixInput.DisplayState.ON_LOGIN);
            }
        }

    }

    @Override
    public void inputReceived(String id, String pwd) {
        if( id == null && pwd == null ) {
            view.displayMessage("Error: No ID and password provided");
        }
        else if( !(id == null) && pwd == null ) { // when only receiving ID, process and if valid, ask password
            processId(id);
        }
        else if( id == null && !(pwd == null) ) { // when only receiving password
            processPwd(pwd);
        }
        else if( !(id == null) && !(pwd == null) ) { // when receiving both ID and password at once
            processId(id);
            if( model.getIdValid() ) {
                processPwd(pwd);
            }
        }
    }

    // gekregen uitleg:
    // id input logica hier (in presenter)
    // return waardes van functies model zijn booleans
    // if/else n.a.v. returnwaardes
    // vertel view vervolgens wat te laten zien
    // enum bijhouden met error codes (verkeerd ww, verkeerd id, blacklisted, etc)
    // enum namen/klassen beginnen met EBenaming
    @Override
    public void processId(String input) {
        if( input == null || input.isBlank() ) {
            // set error 1: empty input
            view.displayMessage("No ID provided.");
           // view.setDisplayState(IMISixInput.DisplayState.ASK_ID); // JH: Added for event driven
            return;
        }
        model.setId(input);
        if( model.isNumericId() ) {
            model.checkLeftPaddingZeroes();
        }
        else {
            //set error 2: not a number
            view.displayMessage("Invalid ID.");
           // view.setDisplayState(IMISixInput.DisplayState.ASK_ID); // JH: Added for event driven
            return;
        }
        if ( model.verifyId() ) {
            if( !model.isBlacklisted() ) {
                model.setIdValid(true);
                view.displayMessage("Provided ID: " + model.getId());
             //   view.setDisplayState(IMISixInput.DisplayState.ASK_PASSWORD); // JH: Added for event driven
                return;
            }
            else {
                // set error 4: blacklisted
                view.displayMessage("This agent has been blocked.");
            //    view.setDisplayState(IMISixInput.DisplayState.ASK_ID); // JH: Added for event driven
                return;
            }
        }
        else {
            // set error 3: invalid ID
            view.displayMessage("This ID is invalid.");
           // view.setDisplayState(IMISixInput.DisplayState.ASK_ID); // JH: Added for event driven
            return;
        }
    }

    @Override
    public void processPwd(String input) {
        if( !model.getIdValid() ) {
            view.displayMessage("Error: asking for password while ID is not valid");
           // view.setDisplayState(IMISixInput.DisplayState.ASK_ID); // JH: Added for event driven
            return;
        }

        model.setPassword(input);
        if( model.verifyPassword() ) {
            model.loginAgent();
            view.displayMessage("Agent " + model.getId() + ", your access has been granted.");
           // view.setDisplayState(IMISixInput.DisplayState.ASK_ID); // JH: Added for event driven
        }
        else {
            model.setIdValid(false);
            model.blacklistAgent();
            // set error 5: incorrect password
            view.displayMessage("Access denied. ID blocked from system.");
           // view.setDisplayState(IMISixInput.DisplayState.ASK_ID); // JH: Added for event driven
        }
    }

    @Override
    public void exitReceived() {
        view.setDisplayState(IMISixInput.DisplayState.EXIT);
    }
}
