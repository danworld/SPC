
-- Create SPC databases

CREATE TABLE pw
(
    pid BIGSERIAL NOT NULL,
    password TEXT NOT NULL,
    hitcount BIGINT DEFAULT 0,
    CONSTRAINT pw_identity PRIMARY KEY (pid)
);