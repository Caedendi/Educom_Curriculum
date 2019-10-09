package nu.educom.bartcommandeur._5b2.presenters;

import nu.educom.bartcommandeur._5b2.models.ILoginValidation;
import nu.educom.bartcommandeur._5b2.models.MI6Error;
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

    // gekregen uitleg:
    // id input logica hier (in presenter)
    // return waardes van functies model zijn booleans
    // if/else n.a.v. returnwaardes
    // vertel view vervolgens wat te laten zien
    // enum bijhouden met error codes (verkeerd ww, verkeerd id, blacklisted, etc)
    // enum namen/klassen beginnen met EBenaming
    @Override
    public void inputReceived(String id, String pwd) {
        // if empty input
        if( id == null && pwd == null ) {
            model.setError(MI6Error.INPUT_EMPTY);
//            view.displayMessage("Error: No ID and password provided");
        }

        // when only receiving ID, process ID. If valid, return.
        else if( !(id == null) && pwd == null ) {
            model.setId(id);
            model.processId();
            if( model.getIdValid() ) {
                view.displayMessage("Provided ID: " + model.getId());
                return;
            }
        }

        // when only receiving password, process password. If valid, login and show message.
        else if( id == null && !(pwd == null) ) {
            model.setPassword(pwd);
            model.processPwd();
            if( model.getPwdValid() ) {
                model.loginAgent();
                view.displayMessage("Agent " + model.getId() + ", your access has been granted.");
                return;
            }
            else {
                model.blacklistAgent();
            }
        }

        // when receiving both ID and password at once
        else if( !(id == null) && !(pwd == null) ) {
            model.setId(id);
            model.processId();
            if( model.getIdValid() ) {
                model.setPassword(pwd);
                model.processPwd();
                if( model.getPwdValid() ) { // success case
                    model.loginAgent();
                    view.displayMessage("Agent " + model.getId() + ", your access has been granted.");
                    return;
                }
                else {
                    model.blacklistAgent();
                }
            }
        }

        // for all cases, if not succes and thus returned, display error
        displayError();
    }

    public void displayError() {
        view.displayMessage(model.getError().getMessage());
        model.clearError();
    }

    @Override
    public void exitReceived() {
        view.setDisplayState(IMISixInput.DisplayState.EXIT);
    }
}
