// import { Link, Head } from '@inertiajs/react';

// export default function Welcome({ auth, laravelVersion, phpVersion }) {
//     return (
//         <>
//             <Head title="Welcome" />
//             <div className="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white">
//                 <div className="sm:fixed sm:top-0 sm:right-0 p-6 text-right">
//                     {auth.user ? (
//                         <Link
//                             href={route('dashboard')}
//                             className="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
//                         >
//                             Dashboard
//                         </Link>
//                     ) : (
//                         <>
//                             <Link
//                                 href={route('login')}
//                                 className="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
//                             >
//                                 Log in
//                             </Link>

//                             <Link
//                                 href={route('register')}
//                                 className="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
//                             >
//                                 Register
//                             </Link>
//                         </>
//                     )}
//                 </div>
//             </div>
//         </>
//     );
// }

import { useEffect, useRef } from "react";
import { useForm } from "@inertiajs/react";
import CardPay from "@/sq-card-pay";

export default function Dashboard({ auth }) {
    const cardContainerRef = useRef(null);
    const cardButtonRef = useRef(null);
    const tokenInputRef = useRef(null);

    useEffect(() => {
        CardPay(cardContainerRef, cardButtonRef, tokenInputRef);
    }, []);

    const { data, setData, post, processing } = useForm({
        token: "",
    });

    const submit = (e) => {
        e.preventDefault();
        console.log(data);
        post(route("payment"));
    };

    return (
        // <AuthenticatedLayout>
        <div>
            <form onSubmit={submit}>
                <div ref={cardContainerRef}></div>
                <input
                    type="hidden"
                    name="token"
                    value={data.token}
                    ref={tokenInputRef}
                    onChange={(e) => setData("token", e.target.value)}
                />
                <button
                    ref={cardButtonRef}
                    //  type="button"
                >
                    Pay $1.00
                </button>
            </form>
            <div id="payment-status-container"></div>
        </div>
        // </AuthenticatedLayout>
    );
}
