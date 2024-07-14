<template>
    <MusicLayout>
        <template #title>
            Liste de mes clés d'API
        </template>
        <template #action>
            <Link :href="route('apiKeys.create')"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold rounded py-2 px-4">
                Créer une clé d'API
            </Link>
        </template>
        <template #content>
            <table class="table-auto">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nom</th>
                        <th>Clé</th>
                        <th>Créée le</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(apiKey, i) in apiKeys" :key="apiKey.uuid">
                        <td>{{ i + 1 }}</td>
                        <td>{{ apiKey.name }}</td>
                        <td>{{ apiKey.key }}</td>
                        <td>{{ $moment(apiKey.created_at).format('DD/MM/YYYY hh:mm:ss') }}</td>
                        <td>
                            <form @submit.prevent="deleteApiKey(apiKey)">
                                <button type="submit"
                                    class="bg-red-500 hover:bg-red-700 text-white font-bold rounded py-2 px-4">
                                    Supprimer
                                </button>
                            </form>
                        </td>
                    </tr>
                </tbody>
            </table>
        </template>
    </MusicLayout>
</template>

<script>
import MusicLayout from '@/Layouts/MusicLayout.vue';

export default {
    name: 'Index',
    components: {
        MusicLayout,
    },
    props: {
        apiKeys: Array,
    },
    methods: {
        deleteApiKey(apiKey) {
            if (confirm('Êtes-vous sûr de vouloir supprimer cette clé ?')) {
                this.$inertia.delete(route('apiKeys.destroy', { apiKey: apiKey }));
            }
        }
    }
}
</script>