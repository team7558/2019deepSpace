/*----------------------------------------------------------------------------*/
/* Copyright (c) 2018 FIRST. All Rights Reserved.                             */
/* Open Source Software - may be modified and shared by FRC teams. The code   */
/* must be accompanied by the FIRST BSD license file in the root directory of */
/* the project.                                                               */
/*----------------------------------------------------------------------------*/

package frc.robot.commands;

import edu.wpi.first.wpilibj.command.Command;
import frc.robot.subsystems.Cargo;
import frc.robot.Robot;

public class ShootCargo extends Command {

  public int num = 0;
  public ShootCargo() {
    super();
    requires(Robot.m_Cargo);
  }

  // Called just before this Command runs the first time
  @Override
  protected void initialize() { 
    num = 0; 
    Robot.m_Cargo.shootCargo();
    setTimeout(3);
  }

  // Called repeatedly when this Command is scheduled to run
  @Override
  protected void execute() {
    num++;
    System.out.println("Execute " + num);
  }

  // Make this return true when this Command no longer needs to run execute()
  @Override
  protected boolean isFinished() {
    boolean timedOut = isTimedOut();
    System.out.println(timedOut);
    return timedOut;
  }

  // Called once after isFinished returns true
  @Override
  protected void end() {
  }

  // Called when another command which requires one or more of the same
  // subsystems is scheduled to run
  @Override
  protected void interrupted() {
  }
}
