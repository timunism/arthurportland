@props(['entry', 'logfile', 'dispatcher'])
<form action="{{ route('logatron.delete') }}" method="POST">
    @csrf
    <input style="display:none" type="text" id="dispatcher" name="dispatcher" value="{{ $dispatcher }}">
    <input style="display:none" type="text" id="logfile" name="logfile" value="{{ $logfile }}">
    <input style="display:none" type="text" id="entry" name="entry" value="{{ $entry }}">
    <input type="submit" name="submit" value="Delete" id="submit" class="px-3 py-1 cursor-pointer bg-red-600 hover:bg-red-700 text-white font-semibold rounded" />
</form>
