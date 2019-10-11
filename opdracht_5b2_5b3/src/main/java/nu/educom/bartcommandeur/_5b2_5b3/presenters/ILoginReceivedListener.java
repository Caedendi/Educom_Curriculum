package nu.educom.bartcommandeur._5b2_5b3.presenters;

public interface ILoginReceivedListener {
    void inputReceived(String id, String pwd);
    void exitReceived();
}
