import './bootstrap';


const channel = Echo.channel('public.playground.1');

channel.subscribed(()=> {
    console.log('TITEE HAS BEEN ALREADY SUBSCRIBED!');
});