package nu.educom.bartcommandeur._5b2.models;

public interface ILoginValidation {
    boolean isNumericId();
    void checkLeftPaddingZeroes();
    boolean verifyId();
    boolean verifyPassword();
    void blacklistAgent();
    boolean isBlacklisted();
    void loginAgent();
    void reset();

    String getId();
    void setId(String id);
    boolean getIdValid();
    void setIdValid(boolean idValid);
    void setPassword(String input);
    boolean isLoggedIn();
}
