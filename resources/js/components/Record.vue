<template>
  <div>
    <div class="flex items-center">
      <audio id="recordedAudio"></audio>
      <button
        type="button"
        class="mx-2 btn btn-danger"
        @click="deleteAudio"
        v-if="finishedRecording"
      >
        <i class="icon ion-md-delete"></i> Delete
      </button>
    </div>
    <div>
      <button
        type="button"
        class="btn btn-primary"
        @click="start"
        v-if="!recording && !finishedRecording"
      >
        <i class="icon ion-md-microphone"></i> Record Audio
      </button>
      <button type="button" class="btn btn-danger" @click="stop" v-if="recording">
        <i class="icon ion-ios-stop"></i> Stop
      </button>
      <input type="hidden" v-model="fileName" name="audio_recorded" />
    </div>
  </div>
</template>

<script>
const MicRecorder = require("mic-recorder-to-mp3");
export default {
  data() {
    return {
      mediaRecorder: "",
      audioChunks: [],
      audioBlob: "",
      audioUrl: "",
      recording: false,
      finishedRecording: false,
      fileName: ""
    };
  },
  methods: {
    start() {
      this.mediaRecorder = new MicRecorder({
        bitRate: 128
      });
      this.mediaRecorder
        .start()
        .then(() => {
          this.recording = true;
        })
        .catch(e => {
          alert("Please allow permission to use your microphone!" + e);
        });
    },
    stop() {
      this.mediaRecorder
        .stop()
        .getMp3()
        .then(([buffer, blob]) => {
          this.recording = false;
          this.finishedRecording = true;
          this.audioBlob = new File(buffer, "audio.mp3", {
            type: blob.type,
            lastModified: Date.now()
          });
          this.audioUrl = URL.createObjectURL(this.audioBlob);
          recordedAudio.src = this.audioUrl;
          recordedAudio.controls = true;
          recordedAudio.autoplay = true;
          var data = new FormData();
          data.append("audio", this.audioBlob);
          var headers = [];
          axios
            .post("/broadcast/processAudio", data, {
              headers: {
                "Content-Type": "multipart/form-data"
              }
            })
            .then(response => {
              if (typeof response.data === "string") {
                this.fileName = response.data;
              } else {
                alert(response.data.message);
              }
            });
        })
        .catch(e => {
          alert("We could not retrieve your message");
          console.log(e);
        });
    },
    deleteAudio(e) {
      var data = new FormData();
      axios
        .post("/broadcast/deleteAudio", { fileName: this.fileName })
        .then(response => {
          if (response) {
            this.finishedRecording = false;
            this.audioChunks = [];
            recordedAudio.src = "";
            recordedAudio.controls = false;
            recordedAudio.autoplay = false;
            this.fileName = "";
          }
        });
    }
  }
};
</script>

<style scoped>
.flex {
  display: flex;
}
.items-center {
  align-items: center;
}
.justify-between {
  justify-content: space-between;
}
</style>
