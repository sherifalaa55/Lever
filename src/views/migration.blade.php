use Illuminate\Database\Migrations\Migration;

class SetupCountriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		// Creates the activations table
		Schema::create(\Config::get('lever.table_name'), function($table)
		{
		    $table->increments('id');
		    $table->integer('activable_id')->unsigned();
		    $table->string('activable_type', 255);
		    $table->boolean("active")->default(1);
		    $table->text('notes')->nullable();
		    $table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop(\Config::get('lever.table_name'));
	}

}
