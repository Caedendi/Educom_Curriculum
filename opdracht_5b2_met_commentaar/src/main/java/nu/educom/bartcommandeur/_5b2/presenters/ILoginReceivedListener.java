package nu.educom.bartcommandeur._5b2.presenters;

public interface ILoginReceivedListener {
    void inputReceived(String id, String pwd);
    void processId(String id);
    void processPwd(String password);
    void exitReceived();
}
