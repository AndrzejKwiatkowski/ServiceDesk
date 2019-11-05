<?php

namespace App\Http\Controllers;

use App\Services\TicketServiceInterface;
use App\Ticket;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\User;
use Auth;
use Illuminate\Support\Facades\View;
use App\Http\Requests\StoreTicket;
use App\Comment;
use Exception;

class TicketController extends Controller
{

    protected $ticketService;

    public function __construct(TicketServiceInterface $ticketService) // czemu tak to wytłumaczyłem w AppServiceProvider
    {
        $this->ticketService = $ticketService;

        $this->middleware('auth'); // to do middlewarera w folderze Http i podpinasz go do routea
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Ticket $tickets, Request $request, User $user) // $tickets, $request jest nieuzywany, $user jest tu kompletnie niepotrzebny
    {
        /**
         * cała logika powinna byc podzielona na 2 cześci, niepotrzebnie pobierasz zawsze wszystkie tickety i tickety jednego usera.
         * kiedy jestes adminem pobierz wszystko i przekaz do widoku, a kiedy jestes userem pobierz tylko usera
         */

        $tickets = Ticket::with('user')->paginate(10);

        $ticketsu = Ticket::where("user_id", "=", Auth::user()->id)->get();


        if (Auth::user()->isAdmin()) { // taka metoda to do modelu, napisałem Ci przykład w modelu, isAdmin(),
            // poza tym takie stałe inty jak np tutaj 1 zawsze do constów w modelu, przykład model Role
            return view('ticket.index', compact('tickets'));
        } else {
            return View::make('ticket.ticketuser')->with(array('user' => $user, 'tickets' => $ticketsu));
            // user nie używasz w widoku, do wyrzucenia
            // nie wiem czemu raz używasz helpera a raz fasady, ujednolić to,
            // helper korzysta pod spodem z tej fasady
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('ticket.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTicket $request)
    {
        /**
         * to robić lepiej przez metode create na modelu
         * Ticket::create([
         *      'tilte' => $request->title itd
         * ]);
         *
         * chyba, ze chcesz triggerować observery, ale nie widzę żebyś je miał.
         * różnica jest taka, że jak masz mass assignment jak przy metodach update i create to działa to szybciej, bo
         * 1. nie tworzysz instancji obiektu
         * 2. wysyłasz gołe zapytanie do mysql bez pobrania rekordu
         *
         *
         * cały ten kod powinien być przeniesiony do następnej warstwy abstrakcji, czyli do jakiegoś servicu typu TicketService,
         * bo co się stanie jak w jakimś innym miejscu aplikacji będziesz też tworzył ticket, wtedy musisz powielić ten kod,
         * a wtedy jak np kiedyś w przyszłości dojdzie Ci kolejna propercja w modelu np. to jak długo ticket jest ważny,
         * to będziesz musiał znaleść wszystkie miejsca gdzie tworzysz ticket i tam to zmienić.
         *
         * napisałem Ci przykład.
         */

//        $ticket = new Ticket();
//        $ticket->title = $request['title'];
//        $ticket->body = $request['body'];
//        $ticket->priorytet = $request['priorytet'];
//        $ticket->user_id = $request->user()->id;
//        $ticket->save();

        $ticket = $this->ticketService->create(array_merge($request->only('title', 'body', 'priorytet')));

        if ($ticket) {
            Auth::user()->tickets()->save($ticket);
        }

        //  $ticket = Ticket::create($request->all()); // o, tu jest spoko
        return redirect('tickets');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Ticekt  $ticekt
     * @return \Illuminate\Http\Response
     */
    public function show(Ticket $ticket)
    {
        $this->authorize('view', $ticket); // przeniósłbym tą autoryzacje do middlewarów https://laravel.com/docs/5.8/authorization#via-middleware
        $comments = $ticket->comments()->with('user')->get(); // tutaj wystraczy Ci zrobić ticket->load('comments')
        // i nie potrzebujesz przekazywac drugiej zmiennej comments do widoku
        return view('ticket.show', compact('ticket', 'comments'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Ticekt  $ticekt
     * @return \Illuminate\Http\Response
     */
    public function edit(Ticket $ticket)
    {
        return view('ticket.edit', compact('ticket'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Ticekt  $ticekt
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ticket $ticket) // $request niepotrzebny
    {

        /**
         *  brakuje tu walidacji
         */

        $this->authorize('update', $ticket); // do middleware https://laravel.com/docs/5.8/authorization#via-middleware
        $ticket->update(request(['title', 'body', 'priorytet', 'user_id'])); // to do TicketService
        return redirect('/tickets');
    }

    public function ticketuser(User $user)
    {

        /**
         * rozumiem, że to ma wyświetlić wszystkie tickety zalogowanego użytkownika?
         * w takim razie ten user w argumencie metody jest niepotrzebny
         */

        $userlogged = $user = Auth::user(); // po co tutaj to podwójne przypisanie? $loggedUser w zupełności wystarczy,
        // jak piszesz nazwy zmiennych to rób to camel casem
        // https://www.php-fig.org/psr/psr-1/
        $tickets = Ticket::where("user_id", "=", $userlogged->id)->get();

        return View::make('ticket.ticketuser')->with(array('user' => $user, 'tickets' => $tickets));
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Ticekt  $ticekt
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ticket $ticket)
    {
        /**
         *  przydałoby się dodać softdelety do wszystkich modeli,
         *  https://laravel.com/docs/5.8/eloquent#soft-deleting
         */
        $ticket->delete();
        return redirect('/tickets');
    }

    public function changestatus(Ticket $ticket, Request $request)
    {

        /**
         * tutaj brakuje walidacji
         *
         * robisz tu dziwną rzecz, najpierw updatujesz w tickecie pole status (o ile to w ogóle zadziała), nie jestem pewien,
         * następnie wyszukujesz ponownie ticket, który już masz w ręku i dopiero wtedy updatujesz inProgressBy,
         * co by jeszcze bylo zabawniej, masz request wstrzyknięty w metode, a używasz helpera
         *
         * jak to powinno byc zrobione to w modelu Ticket powinienes utworzyc metode typu,
         * assignOwner($user) (nie wiem czy nazwa jest najbardziej odpowiednia, pewnie nie)
         * i w środku obsłużyć przydzielanie usera i zmiane statusu.
         * Warto zauważyć, że status chyba w tym przypadku będzie zawsze 'in progress' więc nie wiem po co brać to z requestu, chyba, że się myle
         *
         */

        $ticket->update(request(['status']));
        $ticket = Ticket::find($ticket->id)
            ->update(['inProgressby' => $request->user()->id]);

        return back();
    }
}
