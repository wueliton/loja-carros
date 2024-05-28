import { Head } from "@/Components/Head";
import { THeadProps, Table } from "@/Components/Table";
import { AuthenticatedLayout } from "@/Layouts/Authenticated";
import { PageProps, User } from "@/types";

const usersHeader: THeadProps<User>[] = [
    {
        key: 'name',
        title: 'Nome'
    },
    {
        key: 'email',
        title: 'E-mail'
    }
]

export default function UserPage({
    users,
    auth,
}: PageProps<{ users: User[] }>) {
    return (
        <AuthenticatedLayout>
            <Head title="Usuários" />
            <Table data={users} headers={usersHeader} />
        </AuthenticatedLayout>
    );
}
