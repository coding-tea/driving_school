import "./bootstrap";
import "./alert.js";
import "./mode.js";
import "./nav-bar.js";
// import ClassicEditor from "@ckeditor/ckeditor5-build-classic";
// import {ImageResizeEditing} from "@ckeditor/ckeditor5-image";

// Elements
let voiceTextComponent = $(".voicetext");
let voicetextIcon = $(".voicetext-icon");
let voiceTextIconMicrophone = $(".voicetext-icon-microphone");
// icons
let micIcon = "fa-solid fa-microphone";
let micStopIcon = "fa-solid fa-stop";

// Strings
let voiceTextComponentAttrMicStatus = "data-mic-status";
let voiceTextComponentAttrMicTarget = "data-mic-target";
let microphoneActiveClass = "microphone-active";
let microphoneOn = "on";
let microphoneOff = "off";

$("[name=login]").focus();
$('[data-mic="true"]')
    .find(voicetextIcon)
    .on("click", function () {
        if (
            "SpeechRecognition" in window ||
            "webkitSpeechRecognition" in window
        ) {
            const SpeechRecognition =
                window.SpeechRecognition || window.webkitSpeechRecognition;
            const recognition = new SpeechRecognition();

            let $this = $(this);
            let thisVoiceTextComponent = $this.closest(voiceTextComponent);

            let transcript = "";
            recognition.continuous = true;
            recognition.lang = $("html").attr("lang");

            let targetEl = $(
                `[name=${thisVoiceTextComponent.attr(
                    voiceTextComponentAttrMicTarget
                )}]`
            );

            if (
                thisVoiceTextComponent.attr(voiceTextComponentAttrMicStatus) ==
                microphoneOn
            ) {
                recognition.stop();
                console.log("stop");
                thisVoiceTextComponent.attr(
                    voiceTextComponentAttrMicStatus,
                    microphoneOff
                );
                thisVoiceTextComponent
                    .find(voicetextIcon)
                    .removeClass(microphoneActiveClass);
                thisVoiceTextComponent.find("i").attr("class", micIcon);

                targetEl.css({
                    "box-shadow": "none",
                });
            } else {
                let editor;

                if (window.classicEditors) {
                    let id = targetEl.attr("id");
                    if (window.classicEditors.has(id)) {
                        editor = window.classicEditors.get(id);
                    }
                }
                console.log("start");
                recognition.start();
                recognition.onstart = function () {
                    console.log("Listening...");
                };
                recognition.onresult = function (event) {
                    transcript +=
                        event.results[event.results.length - 1][0].transcript;
                    targetEl.val(transcript);
                    if (editor) {
                        editor.setData(targetEl.val());
                    }
                };
                recognition.onerror = function (event) {
                    console.log(event.error);
                };
                thisVoiceTextComponent.attr(
                    voiceTextComponentAttrMicStatus,
                    microphoneOn
                );
                thisVoiceTextComponent
                    .find(voicetextIcon)
                    .addClass(microphoneActiveClass);
                thisVoiceTextComponent.find("i").attr("class", micStopIcon);
                targetEl.css({
                    "box-shadow": "0px 0px 8px #ffdddd",
                });
            }
        } else {
            console.log("Speech recognition not supported in this browser.");
        }
    });

window.classicEditors = new Map();
$('[data-app-rich="1"]').each(function () {
    ClassicEditor.create(document.querySelector("#" + $(this).attr("id")), {
        ckfinder: {
            uploadUrl: route("uploads.images", {
                _token: document
                    .querySelector('meta[name="csrf-token"]')
                    .getAttribute("content"),
            }),
        },
    })
        .then((editor) => {
            classicEditors.set($(this).attr("id"), editor);

            console.log("Editor was initialized", editor);
        })
        .catch((error) => {
            console.error(error);
        });
});
