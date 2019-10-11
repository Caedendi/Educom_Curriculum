package nu.educom.bartcommandeur._5b2_5b3.presenters;

import nu.educom.bartcommandeur._5b2_5b3.models.ILoginValidation;
import nu.educom.bartcommandeur._5b2_5b3.domainObjects.MI6Error;
import nu.educom.bartcommandeur._5b2_5b3.models.MISixModel;
import nu.educom.bartcommandeur._5b2_5b3.views.IMISixInput;

/* JH: Je moet invoke later alleen gebruiken voor kleine functies die de GUI updaten, niet voor de hele applicatie
    zie: https://www.javamex.com/tutorials/threads/invokelater.shtml

SwingUtilities.invokeLater(new Runnable() {
    @Override
    public void run() {
    }
});
 */
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
        view.setDisplayState(IMISixInput.DisplayState.ASK_ID);
    }

    @Override
    public void inputReceived(String id, String pwd) {
        if( id == null && pwd == null ) {
            model.setError(MI6Error.INPUT_NULL);
            displayError();
            view.setDisplayState(IMISixInput.DisplayState.ASK_ID);
        }
        else if( !(id == null) && pwd == null ) {
            verifyId(id);
        }
        else if( id == null && !(pwd == null) ) {
            verifyPassword(pwd);
        }
        else if( !(id == null) && !(pwd == null) ) {
            verifyIdAndPassword(id, pwd);
        }
    }

    private void verifyId(String id) {
        model.setId(id);
        model.processId();
        if( model.getIdValid() ) {
            view.displayMessage("Provided ID: " + model.getId());
            view.setDisplayState(IMISixInput.DisplayState.ASK_PASSWORD);
            return;
        } else {
            displayError();
            view.setDisplayState(IMISixInput.DisplayState.ASK_ID);
        }
    }

    private void verifyPassword(String pwd) {
        model.setPassword(pwd);
        model.processPwd();
        if( model.getPwdValid() ) { // success case
            model.loginAgent();
            view.displayMessage("Agent " + model.getId() + ", your access has been granted.");
            view.setDisplayState(IMISixInput.DisplayState.ON_LOGIN);
        }
        else {
            model.blacklistAgent();
            displayError();
            view.setDisplayState(IMISixInput.DisplayState.ASK_ID);
        }
    }

    private void verifyIdAndPassword(String id, String pwd) {
        model.setId(id);
        model.processId();
        if( model.getIdValid() ) {
            verifyPassword(pwd);
        }
        else {
            displayError();
        }
    }

    public void displayError() {
        if( model.getError() != null ) {
            view.displayMessage(model.getError().getMessage());
            model.clearError();
        }
    }

    @Override
    public void exitReceived() {
        view.setDisplayState(IMISixInput.DisplayState.EXIT);
    }
}