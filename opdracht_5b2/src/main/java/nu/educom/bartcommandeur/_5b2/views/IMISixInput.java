package nu.educom.bartcommandeur._5b2.views;

import nu.educom.bartcommandeur._5b2.presenters.ILoginReceivedListener;

public interface IMISixInput {
    enum DisplayState {
        BOOT,
        ASK_ID,
        ASK_PASSWORD,
        ON_LOGIN,
        ERROR,
        EXIT
    }
    void addILoginReceivedListener(ILoginReceivedListener lis);
    DisplayState getDisplayState();
    void setDisplayState(DisplayState state);
    void executeCurrentDisplayState();

    void initializeProgram();
    void displayMessage(String message);
    void getIdInput();
    void getPasswordInput();
    void endProgram();
}
