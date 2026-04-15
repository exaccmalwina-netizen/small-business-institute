/**
 * MailchimpSignupForm — SBI Australia
 *
 * ─── HOW TO CONNECT TO MAILCHIMP ──────────────────────────────────────────
 * 1. Log in to Mailchimp → Audience → Signup Forms → Embedded Forms
 * 2. Copy the "form action" URL — looks like:
 *      https://yourdomain.us21.list-manage.com/subscribe/post?u=XXXX&id=XXXX
 * 3. Paste it below as MAILCHIMP_ACTION_URL
 *    IMPORTANT: change "/post?" to "/post-json?" so the browser gets JSON back
 * 4. From the same embedded form, copy the hidden honeypot field name
 *    (the <input name="b_XXXX_XXXX"> element) and paste it as BOT_FIELD_NAME
 * ──────────────────────────────────────────────────────────────────────────
 */

import { useState } from "react";

// ─── CONFIG ────────────────────────────────────────────────────────────────
const MAILCHIMP_ACTION_URL =
  "https://YOUR_DOMAIN.us21.list-manage.com/subscribe/post-json?u=XXXXXXXXXXXXXXXXXXXXXXXX&id=XXXXXXXXXX";

const BOT_FIELD_NAME = "b_XXXXXXXXXXXXXXXXXXXXXXXX_XXXXXXXXXX";
// ──────────────────────────────────────────────────────────────────────────

const COPY = {
  label:           "SBI Newsletter",
  heading_plain:   "Stay ",
  heading_em:      "in the know.",
  subheading:      "Practical guides, compliance updates and real business insights — straight to your inbox.",
  placeholder:     "Your email address",
  cta:             "Subscribe free",
  privacy:         "No spam. Unsubscribe anytime.",
  success_heading: "You're in!",
  success_body:    "Welcome to the SBI community. Your first issue is on its way.",
  error_generic:   "Something went wrong. Please try again.",
};

function submitToMailchimp(actionUrl, email) {
  return new Promise((resolve, reject) => {
    const cbName = `sbi_mc_${Date.now()}`;
    const url = `${actionUrl}&EMAIL=${encodeURIComponent(email)}&c=${cbName}`;
    const script = document.createElement("script");

    window[cbName] = (data) => {
      delete window[cbName];
      document.body.removeChild(script);
      data.result === "success" ? resolve(data.msg) : reject(data.msg);
    };

    script.onerror = () => {
      delete window[cbName];
      document.body.removeChild(script);
      reject(COPY.error_generic);
    };

    script.src = url;
    document.body.appendChild(script);
  });
}

const IconArrow = () => (
  <svg width="15" height="15" viewBox="0 0 15 15" fill="none" aria-hidden="true">
    <path d="M2.5 7.5h10M9 3.5l4 4-4 4" stroke="currentColor" strokeWidth="1.5"
      strokeLinecap="round" strokeLinejoin="round" />
  </svg>
);

const IconCheck = () => (
  <svg width="22" height="22" viewBox="0 0 22 22" fill="none" aria-hidden="true">
    <circle cx="11" cy="11" r="10" stroke="currentColor" strokeWidth="1.5" />
    <path d="M7 11.5l2.8 2.8 5-5.6" stroke="currentColor" strokeWidth="1.5"
      strokeLinecap="round" strokeLinejoin="round" />
  </svg>
);

const IconSpinner = () => (
  <svg width="17" height="17" viewBox="0 0 17 17" fill="none"
    style={{ animation: "sbi-spin .75s linear infinite" }} aria-label="Loading">
    <circle cx="8.5" cy="8.5" r="6.5" stroke="currentColor" strokeWidth="2"
      strokeDasharray="26 14" strokeLinecap="round" />
  </svg>
);

const styles = `
@import url('https://fonts.googleapis.com/css2?family=Instrument+Serif:ital@0;1&family=DM+Sans:opsz,wght@9..40,400;9..40,500&display=swap');

@keyframes sbi-spin   { to { transform: rotate(360deg); } }
@keyframes sbi-appear { from { opacity:0; transform:translateY(8px); } to { opacity:1; transform:translateY(0); } }

.sbi-wrap {
  font-family: 'DM Sans', system-ui, sans-serif;
  background: #f8f6f2;
  border: 1px solid #e2ddd5;
  border-radius: 18px;
  padding: 44px 44px 36px;
  max-width: 500px;
  width: 100%;
  animation: sbi-appear .3s ease both;
  box-sizing: border-box;
}

.sbi-eyebrow {
  display: inline-block;
  font-size: 10.5px;
  font-weight: 500;
  letter-spacing: .1em;
  text-transform: uppercase;
  color: #9e917e;
  margin-bottom: 12px;
}

.sbi-h {
  font-family: 'Instrument Serif', Georgia, serif;
  font-size: 30px;
  font-weight: 400;
  line-height: 1.2;
  color: #1c1b18;
  margin: 0 0 10px;
}
.sbi-h em { font-style: italic; color: #bf5120; }

.sbi-sub {
  font-size: 13.5px;
  line-height: 1.65;
  color: #625d54;
  margin: 0 0 28px;
}

.sbi-row {
  display: flex;
  gap: 8px;
}

.sbi-email {
  flex: 1;
  height: 46px;
  padding: 0 16px;
  font-family: inherit;
  font-size: 14px;
  color: #1c1b18;
  background: #fff;
  border: 1px solid #d5d0c6;
  border-radius: 11px;
  outline: none;
  transition: border-color .15s, box-shadow .15s;
}
.sbi-email::placeholder { color: #b5aea3; }
.sbi-email:focus {
  border-color: #bf5120;
  box-shadow: 0 0 0 3px rgba(191,81,32,.13);
}
.sbi-email:disabled { opacity: .55; }

.sbi-btn {
  display: inline-flex;
  align-items: center;
  gap: 6px;
  height: 46px;
  padding: 0 22px;
  font-family: inherit;
  font-size: 13.5px;
  font-weight: 500;
  color: #fff;
  background: #bf5120;
  border: none;
  border-radius: 11px;
  cursor: pointer;
  white-space: nowrap;
  transition: background .15s, transform .1s;
}
.sbi-btn:hover  { background: #a4431a; }
.sbi-btn:active { transform: scale(.97); }
.sbi-btn:disabled { opacity: .6; cursor: not-allowed; transform: none; }

.sbi-error {
  margin-top: 9px;
  font-size: 12.5px;
  color: #bf5120;
  animation: sbi-appear .2s ease;
}

.sbi-privacy {
  display: flex;
  align-items: center;
  gap: 7px;
  margin-top: 14px;
  font-size: 11.5px;
  color: #a09a90;
}
.sbi-privacy-dot {
  width: 5px; height: 5px;
  border-radius: 50%;
  background: #c8c2b9;
  flex-shrink: 0;
}

.sbi-ok {
  display: flex;
  gap: 14px;
  align-items: flex-start;
  animation: sbi-appear .3s ease;
}
.sbi-ok-icon { color: #bf5120; margin-top: 1px; flex-shrink: 0; }
.sbi-ok h3 {
  font-family: 'Instrument Serif', serif;
  font-size: 24px;
  font-weight: 400;
  color: #1c1b18;
  margin: 0 0 5px;
}
.sbi-ok p { font-size: 13.5px; color: #625d54; margin: 0; line-height: 1.6; }
`;

export default function MailchimpSignupForm() {
  const [email, setEmail]   = useState("");
  const [status, setStatus] = useState("idle");
  const [errMsg, setErrMsg] = useState("");

  const onSubmit = async (e) => {
    e.preventDefault();
    if (!email || status === "loading") return;
    setStatus("loading");
    setErrMsg("");
    try {
      await submitToMailchimp(MAILCHIMP_ACTION_URL, email);
      setStatus("success");
    } catch (err) {
      const msg = typeof err === "string"
        ? err.replace(/<[^>]*>/g, "").trim()
        : COPY.error_generic;
      setErrMsg(msg || COPY.error_generic);
      setStatus("error");
    }
  };

  return (
    <>
      <style>{styles}</style>
      <section className="sbi-wrap" aria-label="Newsletter signup">
        {status === "success" ? (
          <div className="sbi-ok">
            <span className="sbi-ok-icon"><IconCheck /></span>
            <div>
              <h3>{COPY.success_heading}</h3>
              <p>{COPY.success_body}</p>
            </div>
          </div>
        ) : (
          <>
            <span className="sbi-eyebrow">{COPY.label}</span>
            <h2 className="sbi-h">
              {COPY.heading_plain}<em>{COPY.heading_em}</em>
            </h2>
            <p className="sbi-sub">{COPY.subheading}</p>

            <form onSubmit={onSubmit} noValidate>
              <div style={{ position: "absolute", left: "-5000px" }} aria-hidden="true">
                <input type="text" name={BOT_FIELD_NAME} tabIndex={-1} defaultValue="" readOnly />
              </div>

              <div className="sbi-row">
                <input
                  className="sbi-email"
                  type="email"
                  name="EMAIL"
                  value={email}
                  onChange={(e) => setEmail(e.target.value)}
                  placeholder={COPY.placeholder}
                  required
                  disabled={status === "loading"}
                  aria-label="Email address"
                />
                <button
                  className="sbi-btn"
                  type="submit"
                  disabled={status === "loading" || !email}
                >
                  {status === "loading" ? <IconSpinner /> : <>{COPY.cta} <IconArrow /></>}
                </button>
              </div>

              {status === "error" && (
                <p className="sbi-error" role="alert">{errMsg}</p>
              )}

              <p className="sbi-privacy">
                <span className="sbi-privacy-dot" />
                {COPY.privacy}
              </p>
            </form>
          </>
        )}
      </section>
    </>
  );
}
