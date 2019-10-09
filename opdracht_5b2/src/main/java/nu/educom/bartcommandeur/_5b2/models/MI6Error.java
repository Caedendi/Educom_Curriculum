package nu.educom.bartcommandeur._5b2.models;

public enum MI6Error {
    EXAMPLE(
            0,
            "Unused example error.",
            "This error code is unused."
    ),
    ID_INPUT_EMPTY(
            1,
            "No ID provided.",
            "Can not process ID because it was either blank or null."
    ),
    ID_INPUT_NOT_A_NUMBER(
            2,
            "This ID is invalid.",
            "The processed ID is not a (valid) number."
    ),
    ID_INPUT_NOT_IN_VALID_RANGE(
            3,
            "This ID is invalid.",
            "The processed ID is not in the valid range of being equal to or between 1 and 956."
    ),
    ID_BLACKLISTED(
            4,
            "This agent has been blocked.",
            "Because of a previous failed login attempt, this ID was added to the blacklist and is " +
                    "therefore blocked from logging in."
    ),
    PASSWORD_PROCESSING_WITH_INVALID_ID(
            5,
            "Internal error.",
            "Unexpected behaviour: password is being processed while the ID is invalid."
    ),
    PASSWORD_INCORRECT(
            6,
            "Access denied. ID blocked from system.",
            "The password was successfully processed, but was incorrect because it did not match. " +
                    "The ID should now be added to the blacklist."
    ),
    INPUT_EMPTY(
            7,
            "No ID and password provided",
            "Input processing was started, but both values are null."
    );

    private final int code;
    private final String message;
    private final String description;

    MI6Error(int code, String message, String description) {
        this.code = code;
        this.message = message;
        this.description = description;
    }

    public int getCode() {
        return code;
    }

    public String getMessage() {
        return message;
    }

    public String getDescription() {
        return description;
    }

    @Override
    public String toString() {
        return "Error " + code + ": " + message + " \n" + description;
    }
}