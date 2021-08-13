<template>
    <div class="col-span-6 sm:col-span-4">
        <jet-label for="current_password" value="Current Password" />
        <jet-input id="current_password" type="password" class="mt-1 block w-full"  ref="current_password" autocomplete="current-password" />
        <jet-input-error class="mt-2" />
    </div>

</template>
<script>
import Input from "@/Jetstream/Input";
import JetFormSection from "@/Jetstream/FormSection";
import JetInput from "@/Jetstream/Input";
import JetInputError from "@/Jetstream/InputError";
import JetLabel from "@/Jetstream/Label";
export default {
    components: {Input,
        JetFormSection,
        JetInput,
        JetInputError,
        JetLabel,}
}
</script>
