/*----------------------------------------------------------------------------*/
/* Copyright (c) 2018 FIRST. All Rights Reserved.                             */
/* Open Source Software - may be modified and shared by FRC teams. The code   */
/* must be accompanied by the FIRST BSD license file in the root directory of */
/* the project.                                                               */
/*----------------------------------------------------------------------------*/

package frc.robot.subsystems;
import edu.wpi.first.wpilibj.command.Subsystem;
import com.ctre.phoenix.sensors.PigeonIMU;
import edu.wpi.first.wpilibj.SpeedControllerGroup;
import edu.wpi.first.wpilibj.command.Subsystem;
import edu.wpi.first.wpilibj.drive.DifferentialDrive;
import frc.robot.RobotMap;
import com.revrobotics.CANSparkMax;
import com.revrobotics.CANSparkMaxLowLevel.MotorType;
import com.revrobotics.CANEncoder;

/**
 * Add your docs here.
 */
public class DriveTrain extends Subsystem {
  private double kP = 0, kI = 0, kD = 0; 
  private PigeonIMU m_pidgey = new PigeonIMU(3); // 3 is can ID
  private static CANSparkMax[] m_motors = new CANSparkMax[7];
  private static CANEncoder[] m_encoders = new CANEncoder[m_motors.length];
  private static SpeedControllerGroup m_leftMotorGroup, m_rightMotorGroup;
  private double[] ypr = new double[3];
  private DifferentialDrive m_driveTrain;
  private double Integral;
  private double previousError = 0;


  // Put methods for controlling this subsystem
  // here. Call these from Commands.

  public DriveTrain(){
    super();

    m_motors[1] = new CANSparkMax(RobotMap.LEFT_MOTOR_1, MotorType.kBrushless);
    m_motors[2] = new CANSparkMax(RobotMap.LEFT_MOTOR_2, MotorType.kBrushless);
    m_motors[3] = new CANSparkMax(RobotMap.LEFT_MOTOR_3, MotorType.kBrushless);
    m_motors[4] = new CANSparkMax(RobotMap.RIGHT_MOTOR_1, MotorType.kBrushless);
    m_motors[5] = new CANSparkMax(RobotMap.RIGHT_MOTOR_2, MotorType.kBrushless);
    m_motors[6] = new CANSparkMax(RobotMap.RIGHT_MOTOR_3, MotorType.kBrushless);
    for (int i = 0; i < m_motors.length; i++) {
      m_encoders[i] = new CANEncoder(m_motors[i]);
    }
    m_leftMotorGroup = new SpeedControllerGroup(m_motors[1], m_motors[2], m_motors[3]);
    m_rightMotorGroup = new SpeedControllerGroup(m_motors[4], m_motors[5], m_motors[6]);
    m_driveTrain = new DifferentialDrive(m_leftMotorGroup, m_rightMotorGroup);
  }

  @Override
  public void initDefaultCommand() {
    // Set the default command for a subsystem here.
    // setDefaultCommand(new MySpecialCommand());
  }

  public double PID(double target){
    m_pidgey.getYawPitchRoll(ypr);
    double error =  target - ypr[0];
    double pTerm = error * kP;
    Integral += error;
    double iTerm = Integral * kI;
    double dTerm = kD * (previousError - error);
    previousError = error;
    return pTerm + iTerm + dTerm;
  }

  
}
