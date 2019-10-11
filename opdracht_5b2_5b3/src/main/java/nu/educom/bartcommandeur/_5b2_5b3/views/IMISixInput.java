package nu.educom.bartcommandeur._5b2_5b3.views;

import nu.educom.bartcommandeur._5b2_5b3.presenters.ILoginReceivedListener;

public interface IMISixInput {
    enum DisplayState {
        BOOT,
        ASK_ID,
        ASK_PASSWORD,
        ON_LOGIN,
        EXIT
    }
    void addILoginReceivedListener(ILoginReceivedListener lis);
    void initializeProgram();
    void setDisplayState(DisplayState state);
    void executeCurrentDisplayState();
    void displayMessage(String message);
    void endProgram();
}
