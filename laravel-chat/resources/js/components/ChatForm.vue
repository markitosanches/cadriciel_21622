<template>
    <div class="input-group">
        <input 
        class="form-control input-sm"
        type="text"
        placeholder="Type your message..."
        v-model="newMessage"
        @keyup.enter="sendMessage"
        />
        <span class="input-group-btn">
            <button class="btn btn-primary btn-sm" @click="sendMessage">
                Send
            </button>
        </span>
    </div>
</template>

<script>
export default {
   props: ["user"],
    data() {
        return {
            newMessage: null
        }
    },
    methods: {
        sendMessage(){
            this.$emit("messagesent", {
            user: this.user,
            message: this.newMessage
            });
            this.newMessage = null
        }
    }
}
</script>