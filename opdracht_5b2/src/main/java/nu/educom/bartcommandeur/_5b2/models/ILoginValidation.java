package nu.educom.bartcommandeur._5b2.models;

public interface ILoginValidation {
    void processId();
    boolean isNumericId();
    void checkLeftPaddingZeroes();
    boolean verifyId();

    void processPwd();
    boolean verifyPassword();
    void loginAgent();

    void blacklistAgent();
    boolean isBlacklisted();
    void reset();

    String getId();
    void setId(String id);
    boolean getIdValid();
    void setIdValid(boolean idValid);
    void setPassword(String input);
    boolean getPwdValid();
    void setPwdValid(boolean pwdValid);
    boolean isLoggedIn();
    MI6Error getError();
    void setError(MI6Error error);
    void clearError();
}
